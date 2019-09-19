<?php

namespace App\Http\Controllers\Web;

use App\Eleccion;
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

    public function resultados_generales($id){

        $eleccion = Eleccion::findOrFail($id);
        $resultados = DB::select(
            'SELECT SUM(resultado.total) as total, participante.color, participante.sigla
             FROM resultado,participante_eleccion, participante  
             WHERE participante_eleccion.participante_id = participante.id 
             AND resultado.participante_eleccion_id = participante_eleccion.id
             AND participante_eleccion.eleccion_id = ?
             GROUP BY participante.sigla, participante.color
             ORDER BY total DESC', [$id])
        ;

        return view('vistas.web.resultados',
            [
                'eleccion' => $eleccion,
                'resultados' => $resultados,
            ]);
    }
}
