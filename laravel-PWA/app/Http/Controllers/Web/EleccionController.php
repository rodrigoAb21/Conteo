<?php

namespace App\Http\Controllers\Web;

use App\Departamento;
use App\Eleccion;
use App\Municipio;
use App\Mesa;
use App\Partido;
use App\PartidoEleccion;
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

        $partidos = DB::table('partido')
            ->join('partido_eleccion', 'partido.id', '=', 'partido_eleccion.partido_id')
            ->where('partido_eleccion.eleccion_id', '=', $id)
            ->get();

        $opciones = Partido::whereNotIn('id', function($query) use ($id) {
            $query->from('partido_eleccion')
                ->select('partido_id')
                ->where('eleccion_id','=', $id)
                ->get();
        })->get();

        return view('vistas.elecciones.asignacion',
            [
                'eleccion' => $eleccion,
                'partidos' => $partidos,
                'opciones' => $opciones,
            ]);
    }

    public function asignar($id, Request $request)
    {
        if ($request['partido_id'] != null) {
            $partido = new PartidoEleccion();
            $partido->eleccion_id = $id;
            $partido->partido_id = $request['partido_id'];
            $partido->save();
        }

        return redirect('admin/elecciones/asignaciones/' . $id);
    }

    public function quitar($id_eleccion, $id_p_e)
    {
        $partido = PartidoEleccion::findOrFail($id_p_e);
        $partido->delete();

        return redirect('admin/elecciones/asignaciones/' . $id_eleccion);
    }


    public function resultados_generales($eleccion_id){

        $resultados = DB::select(
            'SELECT SUM(resultado.total) as total, partido.color, partido.sigla
             FROM resultado,partido_eleccion, partido
             WHERE partido_eleccion.partido_id = partido.id
             AND resultado.partido_eleccion_id = partido_eleccion.id
             AND partido_eleccion.eleccion_id = ?
             GROUP BY partido.sigla, partido.color
             ORDER BY total DESC', [$eleccion_id])
        ;

        $total = 0;

        foreach ($resultados as $resultado){
            $total = $total + $resultado->total;
        }


        return view('vistas.elecciones.resultados',
            [
                'resultados' => $resultados,
                'total' => $total,
                'eleccion' => Eleccion::findOrFail($eleccion_id),
                'departamentos' => Departamento::paginate(10),
            ]);
    }

    public function resultados_departamento($eleccion_id, $dpto_id){
        $eleccion = Eleccion::findOrFail($eleccion_id);
        $resultados = DB::select(
            'SELECT SUM(resultado.total) as total, partido.color, partido.sigla
             FROM resultado,partido_eleccion, partido, mesa, recinto, municipio, provincia
             WHERE partido_eleccion.partido_id = partido.id
             AND resultado.partido_eleccion_id = partido_eleccion.id
             AND resultado.mesa_id = mesa.id
             AND mesa.recinto_id = recinto.id
             AND recinto.municipio_id = municipio.id
             AND municipio.provincia_id = provincia.id
             AND provincia.departamento_id = ?
             AND partido_eleccion.eleccion_id = ?
             GROUP BY partido.sigla, partido.color
             ORDER BY total DESC', [$dpto_id, $eleccion_id])
        ;
        $total = 0;

        foreach ($resultados as $resultado){
            $total = $total + $resultado->total;
        }


        return view('vistas.elecciones.resultados_departamento',
            [
                'resultados' => $resultados,
                'total' => $total,
                'eleccion' => Eleccion::findOrFail($eleccion_id),
                'departamento' => Departamento::findOrFail($dpto_id),
                'provincias' => Provincia::where('departamento_id', '=', $dpto_id)->paginate(10),
            ]);
    }

    public function resultados_provincia($eleccion_id, $dpto_id, $prov_id){

        $resultados = DB::select(
            'SELECT SUM(resultado.total) as total, partido.color, partido.sigla
             FROM resultado,partido_eleccion, partido, mesa, recinto, municipio
             WHERE partido_eleccion.partido_id = partido.id
             AND resultado.partido_eleccion_id = partido_eleccion.id
             AND resultado.mesa_id = mesa.id
             AND mesa.recinto_id = recinto.id
             AND recinto.municipio_id = municipio.id
             AND municipio.provincia_id = ?
             AND partido_eleccion.eleccion_id = ?
             GROUP BY partido.sigla, partido.color
             ORDER BY total DESC', [$prov_id, $eleccion_id])
        ;

        $total = 0;

        foreach ($resultados as $resultado){
            $total = $total + $resultado->total;
        }


        return view('vistas.elecciones.resultados_provincia',
            [
                'resultados' => $resultados,
                'total' => $total,
                'eleccion' => Eleccion::findOrFail($eleccion_id),
                'departamento' => Departamento::findOrFail($dpto_id),
                'provincia' => Provincia::findOrFail($prov_id),
                'municipios' => Municipio::where('provincia_id', '=', $prov_id)->paginate(10),
            ]);
    }

    public function resultados_municipio($eleccion_id, $dpto_id, $prov_id, $mun_id){

        $resultados = DB::select(
            'SELECT SUM(resultado.total) as total, partido.color, partido.sigla
             FROM resultado,partido_eleccion, partido, mesa, recinto
             WHERE partido_eleccion.partido_id = partido.id
             AND resultado.partido_eleccion_id = partido_eleccion.id
             AND resultado.mesa_id = mesa.id
             AND mesa.recinto_id = recinto.id
             AND recinto.municipio_id = ?
             AND partido_eleccion.eleccion_id = ?
             GROUP BY partido.sigla, partido.color
             ORDER BY total DESC', [$mun_id, $eleccion_id])
        ;
        $total = 0;

        foreach ($resultados as $resultado){
            $total = $total + $resultado->total;
        }


        return view('vistas.elecciones.resultados_municipio',
            [
                'resultados' => $resultados,
                'total' => $total,
                'eleccion' => Eleccion::findOrFail($eleccion_id),
                'departamento' => Departamento::findOrFail($dpto_id),
                'provincia' => Provincia::findOrFail($prov_id),
                'municipio' => Municipio::findOrFail($mun_id),
                'recintos' => Recinto::where('municipio_id', '=', $mun_id)->paginate(10),
            ]);
    }

    public function resultados_recinto($eleccion_id, $dpto_id, $prov_id, $mun_id, $rec_id){

        $resultados = DB::select(
            'SELECT SUM(resultado.total) as total, partido.color, partido.sigla
             FROM resultado,partido_eleccion, partido, mesa
             WHERE partido_eleccion.partido_id = partido.id
             AND resultado.partido_eleccion_id = partido_eleccion.id
             AND resultado.mesa_id = mesa.id
             AND mesa.recinto_id = ?
             AND partido_eleccion.eleccion_id = ?
             GROUP BY partido.sigla, partido.color
             ORDER BY total DESC', [$rec_id, $eleccion_id])
        ;

        $total = 0;

        foreach ($resultados as $resultado){
            $total = $total + $resultado->total;
        }

        return view('vistas.elecciones.resultados_recinto',
            [
                'resultados' => $resultados,
                'total' => $total,
                'eleccion' => Eleccion::findOrFail($eleccion_id),
                'departamento' => Departamento::findOrFail($dpto_id),
                'provincia' => Provincia::findOrFail($prov_id),
                'municipio' => Municipio::findOrFail($mun_id),
                'recinto' => Recinto::findOrFail($rec_id),
                'mesas' => Mesa::where('recinto_id', '=', $rec_id)->paginate(10),
            ]);
    }

    public function resultados_mesa($eleccion_id, $dpto_id, $prov_id, $mun_id, $rec_id, $mesa_id){

        $resultados = DB::select(
            'SELECT SUM(resultado.total) as total, partido.color, partido.sigla
             FROM resultado,partido_eleccion, partido
             WHERE partido_eleccion.partido_id = partido.id
             AND resultado.partido_eleccion_id = partido_eleccion.id
             AND resultado.mesa_id = ?
             AND partido_eleccion.eleccion_id = ?
             GROUP BY partido.sigla, partido.color
             ORDER BY total DESC', [$mesa_id, $eleccion_id])
        ;
        $total = 0;

        foreach ($resultados as $resultado){
            $total = $total + $resultado->total;
        }


        return view('vistas.elecciones.resultados_mesa',
            [
                'resultados' => $resultados,
                'total' => $total,
                'eleccion' => Eleccion::findOrFail($eleccion_id),
                'departamento' => Departamento::findOrFail($dpto_id),
                'provincia' => Provincia::findOrFail($prov_id),
                'municipio' => Municipio::findOrFail($mun_id),
                'recinto' => Recinto::findOrFail($rec_id),
                'mesa' => Mesa::findOrFail($mesa_id),
            ]);
    }
}
