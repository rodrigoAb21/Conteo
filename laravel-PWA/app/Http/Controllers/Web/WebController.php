<?php

namespace App\Http\Controllers\Web;

use App\Departamento;
use App\Eleccion;
use App\Municipio;
use App\Mesa;
use App\Provincia;
use App\Recinto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function getEleccionesActivas(){
        $elecciones = Eleccion::
        where('estado', '!=', 'En espera')
            ->get();
        return view('vistas.web.elecciones',
            [
                'elecciones' => $elecciones,
            ]);
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



        return view('vistas.web.resultados',
            [
                'resultados' => $resultados,
                'total' => $total,
                'eleccion' => Eleccion::findOrFail($eleccion_id),
                'departamentos' => Departamento::paginate(10),
            ]);
    }

    public function resultados_departamento($eleccion_id, $dpto_id){
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

        return view('vistas.web.resultados_departamento',
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


        return view('vistas.web.resultados_provincia',
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


        return view('vistas.web.resultados_municipio',
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


        return view('vistas.web.resultados_recinto',
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


        return view('vistas.web.resultados_mesa',
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
