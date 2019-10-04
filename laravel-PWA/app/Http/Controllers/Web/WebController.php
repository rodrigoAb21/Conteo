<?php

namespace App\Http\Controllers\Web;

use App\Departamento;
use App\Eleccion;
use App\Localidad;
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
            'SELECT SUM(resultado.total) as total, participante.color, participante.sigla
             FROM resultado,participante_eleccion, participante  
             WHERE participante_eleccion.participante_id = participante.id 
             AND resultado.participante_eleccion_id = participante_eleccion.id
             AND participante_eleccion.eleccion_id = ?
             GROUP BY participante.sigla, participante.color
             ORDER BY total DESC', [$eleccion_id])
        ;


        return view('vistas.web.resultados',
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


        return view('vistas.web.resultados_departamento',
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



        return view('vistas.web.resultados_provincia',
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


        return view('vistas.web.resultados_localidad',
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


        return view('vistas.web.resultados_recinto',
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


        return view('vistas.web.resultados_mesa',
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
