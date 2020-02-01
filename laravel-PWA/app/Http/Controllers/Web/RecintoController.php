<?php

namespace App\Http\Controllers\Web;

use App\Municipio;
use App\Recinto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecintoController extends Controller
{
    public function index()
    {
        return view('vistas.recintos.index',
            [
                'recintos' => Recinto::paginate(10),
            ]);
    }

    public function create()
    {
        return view('vistas.recintos.create',
            [
                'municipios' => Municipio::all(),
            ]);
    }


    public function store(Request $request)
    {
        $recinto = new Recinto();
        $recinto->nombre = $request['nombre'];
        $recinto->direccion = $request['direccion'];
        $recinto->municipio_id = $request['municipio_id'];
        $recinto->save();

        return redirect('admin/recintos');
    }

    public function edit($id)
    {
        return view('vistas.recintos.edit',
            [
                'recinto' => Recinto::findOrFail($id),
                'municipios' => Municipio::all(),
            ]);
    }


    public function update(Request $request, $id)
    {
        $recinto = Recinto::findOrFail($id);
        $recinto->nombre = $request['nombre'];
        $recinto->direccion = $request['direccion'];
        $recinto->municipio_id = $request['municipio_id'];
        $recinto->update();

        return redirect('admin/recintos');
    }


    public function destroy($id)
    {
        $recinto = Recinto::findOrFail($id);
        $recinto->delete();

        return redirect('admin/recintos');
    }
}
