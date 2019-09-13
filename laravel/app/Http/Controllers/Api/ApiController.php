<?php

namespace App\Http\Controllers\Api;

use App\Eleccion;
use App\Participante;
use App\ParticipanteEleccion;
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
            ->get();
        return $elecciones;
    }

    public function guardarResultados(Request $request)
    {
        try {
            DB::beginTransaction();
            $eleccion_id = $request['eleccion_id'];
            $mesa_id = $request['mesa_id'];
            $resultados = $request['resultados'];
            foreach ($resultados as $resultado) {
                $resultado2 = new Resultado();
                $resultado2->mesa_id = $mesa_id;
                $resultado2->participante_eleccion_id = $this->getParticipante($eleccion_id, $resultado['nombre']);
                $resultado2->total = $resultado['total'];
                $resultado2->save();
            }

            DB::commit();
            return response()->json(null,200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(null,500);
        }


    }

    public function getParticipante($eleccion_id, $nombre)
    {
        $id = -1;
        $participante_id = Participante::select('id')
            ->where('nombre', '=' , $nombre)
            ->first();

        if ($participante_id != null) {
            $pe_id = ParticipanteEleccion::select('id')
                ->where('eleccion_id', '=', $eleccion_id)
                ->where('participante_id', '=', $participante_id->id)
                ->first();
            if ($pe_id != null) {
                $id = $pe_id->id;
            }
        }

        return $id;

    }
}
