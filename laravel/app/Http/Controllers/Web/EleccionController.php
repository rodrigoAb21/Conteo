<?php

namespace App\Http\Controllers\Web;

use App\Eleccion;
use App\Participante;
use App\ParticipanteEleccion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EleccionController extends Controller
{
    public function index()
    {
       return view('vistas.elecciones.index',
           ['elecciones' => Eleccion::paginate(10)]);
    }

    public function create()
    {
        $tipos = [
            'Presidencial',
            'Departamental',
            'Municipal',
            ];
        $estados = [
            'Es espera',
            'En proceso',
            'Finalizada',
        ];
        return view('vistas.elecciones.create',
            [
                'tipos' => $tipos,
                'estados' => $estados,
            ]);
    }


    public function store(Request $request)
    {
        $eleccion = new Eleccion();
        $eleccion->nombre = $request['nombre'];
        $eleccion->fecha = $request['fecha'];
        $eleccion->estado = $request['estado'];
        $eleccion->mesas = $request['mesas'];
        $eleccion->tipo = $request['tipo'];
        $eleccion->save();

        return redirect('admin/elecciones');
    }

    public function edit($id)
    {
        $tipos = [
            'Presidencial',
            'Departamental',
            'Municipal',
            ];

        $estados = [
            'Es espera',
            'En proceso',
            'Finalizada',
        ];
        return view('vistas.elecciones.edit',
            [
                'tipos' => $tipos,
                'estados' => $estados,
                'eleccion' => Eleccion::findOrFail($id),
            ]);
    }


    public function update(Request $request, $id)
    {
        $eleccion = Eleccion::findOrFail($id);
        $eleccion->nombre = $request['nombre'];
        $eleccion->fecha = $request['fecha'];
        $eleccion->estado = $request['estado'];
        $eleccion->mesas = $request['mesas'];
        $eleccion->tipo = $request['tipo'];
        $eleccion->update();

        return redirect('admin/elecciones');
    }


    public function destroy($id)
    {
        $eleccion = Eleccion::findOrFail($id);
        $eleccion->delete();

        return redirect('admin/elecciones');
    }

    public function mostrarResultados($id){

        $eleccion = Eleccion::findOrFail($id);
        $resultados = DB::select(
            'SELECT SUM(resultado.total) as total, participante.color, participante.nombre
             FROM resultado,participante_eleccion, participante  
             WHERE participante_eleccion.participante_id = participante.id 
             AND resultado.participante_eleccion_id = participante_eleccion.id
             AND participante_eleccion.eleccion_id = ?
             GROUP BY participante.nombre, participante.color
             ORDER BY total DESC', [$id])
        ;

        return view('vistas.elecciones.resultados',
            [
                'eleccion' => $eleccion,
                'resultados' => $resultados,
            ]);
    }

    public function verAsignacion($id)
    {
        $eleccion = Eleccion::findOrFail($id);

        $participantes = DB::table('participante')
            ->join('participante_eleccion', 'participante.id', '=', 'participante_eleccion.participante_id')
            ->where('participante_eleccion.eleccion_id', '=', $id)
            ->get();

        $opciones = Participante::whereNotIn('id', function($query) use ($id) {
            $query->from('participante_eleccion')
                ->select('participante_id')
                ->where('eleccion_id','=', $id)
                ->get();
        })->get();

        return view('vistas.elecciones.asignacion',
            [
                'eleccion' => $eleccion,
                'participantes' => $participantes,
                'opciones' => $opciones,
            ]);
    }

    public function asignar($id, Request $request)
    {
        $participante = new ParticipanteEleccion();
        $participante->eleccion_id = $id;
        $participante->participante_id = $request['participante_id'];
        $participante->save();

        return redirect('admin/elecciones/asignaciones/' . $id);
    }

    public function quitar($id_eleccion, $id_p_e)
    {
        $participante = ParticipanteEleccion::findOrFail($id_p_e);
        $participante->delete();

        return redirect('admin/elecciones/asignaciones/' . $id_eleccion);
    }
}
