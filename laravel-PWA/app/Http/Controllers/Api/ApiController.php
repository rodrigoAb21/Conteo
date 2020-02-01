<?php

namespace App\Http\Controllers\Api;

use App\Eleccion;
use App\Resultado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getEleccionesActivas()
    {
        $elecciones = Eleccion::
        where('estado', '!=', 'En espera')
            ->select('id', 'nombre')
            ->get();

        foreach ($elecciones as $eleccion){
            $eleccion->partidos = DB::table('partido')
                ->join('partido_eleccion', 'partido.id', '=', 'partido_eleccion.partido_id')
                ->where('partido_eleccion.eleccion_id', '=', $eleccion->id)
                ->select('partido_eleccion.id', 'sigla')
                ->get();
        }

        return $elecciones;
    }

    public function guardarResultados(Request $request)
    {
            $mesa_id = $request['mesaId'];
            $resultados = $request['resultados'];
            foreach ($resultados as $resultado) {
                try{
                    $resultado2 = new Resultado();
                    $resultado2->mesa_id = $mesa_id;
                    $resultado2->partido_eleccion_id = $resultado['id'];
                    $resultado2->total = $resultado['total'];
                    $resultado2->save();
                } catch (\Exception $e){
                    // algo :v
                }
            }

            return response()->json(null,200);

    }
}
