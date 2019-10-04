<?php

namespace App\Http\Controllers\Web;

use App\Departamento;
use App\Eleccion;
use App\Localidad;
use App\Mesa;
use App\Participante;
use App\ParticipanteEleccion;
use App\Provincia;
use App\Recinto;
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
            'En espera',
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
            'En espera',
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
        if ($request['participante_id'] != null) {
            $participante = new ParticipanteEleccion();
            $participante->eleccion_id = $id;
            $participante->participante_id = $request['participante_id'];
            $participante->save();
        }

        return redirect('admin/elecciones/asignaciones/' . $id);
    }

    public function quitar($id_eleccion, $id_p_e)
    {
        $participante = ParticipanteEleccion::findOrFail($id_p_e);
        $participante->delete();

        return redirect('admin/elecciones/asignaciones/' . $id_eleccion);
    }


    public function resultados_generales($eleccion_id){

        $resultados = DB::select(
            'SELECT SUM(resultado.total) as total, participante.color, participante.sigla
             FROM resultado,participante_eleccion, participante  
             WHERE participante_eleccion.participante_id = participante.id 
             AND resultado.participante_eleccion_id = participante_eleccion.id
             AND participante_eleccion.eleccion_id = ?
             GROUP BY participante.sigla, participante.color
             ORDER BY total DESC', [$eleccion_id])
        ;


        return view('vistas.elecciones.resultados',
            [
                'resultados' => $resultados,
                'eleccion' => Eleccion::findOrFail($eleccion_id),
                'departamentos' => Departamento::paginate(10),
            ]);
    }

    public function resultados_departamento($eleccion_id, $dpto_id){
        $eleccion = Eleccion::findOrFail($eleccion_id);
        $resultados = DB::select(
            'SELECT SUM(resultado.total) as total, participante.color, participante.sigla
             FROM resultado,participante_eleccion, participante, mesa, recinto, localidad, provincia
             WHERE participante_eleccion.participante_id = participante.id 
             AND resultado.participante_eleccion_id = participante_eleccion.id
             AND resultado.mesa_id = mesa.id
             AND mesa.recinto_id = recinto.id
             AND recinto.localidad_id = localidad.id
             AND localidad.provincia_id = provincia.id
             AND provincia.departamento_id = ?
             AND participante_eleccion.eleccion_id = ?
             GROUP BY participante.sigla, participante.color
             ORDER BY total DESC', [$dpto_id, $eleccion_id])
        ;


        return view('vistas.elecciones.resultados_departamento',
            [
                'resultados' => $resultados,
                'eleccion' => Eleccion::findOrFail($eleccion_id),
                'departamento' => Departamento::findOrFail($dpto_id),
                'provincias' => Provincia::where('departamento_id', '=', $dpto_id)->paginate(10),
            ]);
    }

    public function resultados_provincia($eleccion_id, $dpto_id, $prov_id){

        $resultados = DB::select(
            'SELECT SUM(resultado.total) as total, participante.color, participante.sigla
             FROM resultado,participante_eleccion, participante, mesa, recinto, localidad
             WHERE participante_eleccion.participante_id = participante.id 
             AND resultado.participante_eleccion_id = participante_eleccion.id
             AND resultado.mesa_id = mesa.id
             AND mesa.recinto_id = recinto.id
             AND recinto.localidad_id = localidad.id
             AND localidad.provincia_id = ?
             AND participante_eleccion.eleccion_id = ?
             GROUP BY participante.sigla, participante.color
             ORDER BY total DESC', [$prov_id, $eleccion_id])
        ;



        return view('vistas.elecciones.resultados_provincia',
            [
                'resultados' => $resultados,
                'eleccion' => Eleccion::findOrFail($eleccion_id),
                'departamento' => Departamento::findOrFail($dpto_id),
                'provincia' => Provincia::findOrFail($prov_id),
                'localidades' => Localidad::where('provincia_id', '=', $prov_id)->paginate(10),
            ]);
    }

    public function resultados_localidad($eleccion_id, $dpto_id, $prov_id, $local_id){

        $resultados = DB::select(
            'SELECT SUM(resultado.total) as total, participante.color, participante.sigla
             FROM resultado,participante_eleccion, participante, mesa, recinto
             WHERE participante_eleccion.participante_id = participante.id 
             AND resultado.participante_eleccion_id = participante_eleccion.id
             AND resultado.mesa_id = mesa.id
             AND mesa.recinto_id = recinto.id
             AND recinto.localidad_id = ?
             AND participante_eleccion.eleccion_id = ?
             GROUP BY participante.sigla, participante.color
             ORDER BY total DESC', [$local_id, $eleccion_id])
        ;


        return view('vistas.elecciones.resultados_localidad',
            [
                'resultados' => $resultados,
                'eleccion' => Eleccion::findOrFail($eleccion_id),
                'departamento' => Departamento::findOrFail($dpto_id),
                'provincia' => Provincia::findOrFail($prov_id),
                'localidad' => Localidad::findOrFail($local_id),
                'recintos' => Recinto::where('localidad_id', '=', $local_id)->paginate(10),
            ]);
    }

    public function resultados_recinto($eleccion_id, $dpto_id, $prov_id, $local_id, $rec_id){

        $resultados = DB::select(
            'SELECT SUM(resultado.total) as total, participante.color, participante.sigla
             FROM resultado,participante_eleccion, participante, mesa
             WHERE participante_eleccion.participante_id = participante.id 
             AND resultado.participante_eleccion_id = participante_eleccion.id
             AND resultado.mesa_id = mesa.id
             AND mesa.recinto_id = ?
             AND participante_eleccion.eleccion_id = ?
             GROUP BY participante.sigla, participante.color
             ORDER BY total DESC', [$rec_id, $eleccion_id])
        ;


        return view('vistas.elecciones.resultados_recinto',
            [
                'resultados' => $resultados,
                'eleccion' => Eleccion::findOrFail($eleccion_id),
                'departamento' => Departamento::findOrFail($dpto_id),
                'provincia' => Provincia::findOrFail($prov_id),
                'localidad' => Localidad::findOrFail($local_id),
                'recinto' => Recinto::findOrFail($rec_id),
                'mesas' => Mesa::where('recinto_id', '=', $rec_id)->paginate(10),
            ]);
    }

    public function resultados_mesa($eleccion_id, $dpto_id, $prov_id, $local_id, $rec_id, $mesa_id){

        $resultados = DB::select(
            'SELECT SUM(resultado.total) as total, participante.color, participante.sigla
             FROM resultado,participante_eleccion, participante
             WHERE participante_eleccion.participante_id = participante.id 
             AND resultado.participante_eleccion_id = participante_eleccion.id
             AND resultado.mesa_id = ?
             AND participante_eleccion.eleccion_id = ?
             GROUP BY participante.sigla, participante.color
             ORDER BY total DESC', [$mesa_id, $eleccion_id])
        ;


        return view('vistas.elecciones.resultados_mesa',
            [
                'resultados' => $resultados,
                'eleccion' => Eleccion::findOrFail($eleccion_id),
                'departamento' => Departamento::findOrFail($dpto_id),
                'provincia' => Provincia::findOrFail($prov_id),
                'localidad' => Localidad::findOrFail($local_id),
                'recinto' => Recinto::findOrFail($rec_id),
                'mesa' => Mesa::findOrFail($mesa_id),
            ]);
    }
}
