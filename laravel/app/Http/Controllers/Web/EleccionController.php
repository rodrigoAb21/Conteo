<?php

namespace App\Http\Controllers\Web;

use App\Eleccion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        return redirect('elecciones');
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

        return redirect('elecciones');
    }


    public function destroy($id)
    {
        $eleccion = Eleccion::findOrFail($id);
        $eleccion->delete();

        return redirect('elecciones');
    }
}
