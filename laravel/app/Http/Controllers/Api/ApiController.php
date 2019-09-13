<?php

namespace App\Http\Controllers\Api;

use App\Eleccion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function getEleccionesActivas(){
        $elecciones = Eleccion::
        where('estado', '!=', 'En espera')
            ->get();
        return $elecciones;
    }
}
