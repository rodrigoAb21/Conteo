<?php

namespace App\Http\Controllers\Web;

use App\Recinto;
use App\Mesa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MesaController extends Controller
{
    public function index()
    {
        return view('vistas.mesas.index',
            [
                'mesas' => Mesa::paginate(10),
            ]);
    }

    public function create()
    {
        return view('vistas.mesas.create',
            [
                'recintos' => Recinto::all(),
            ]);
    }


    public function store(Request $request)
    {
        $mesa = new Mesa();
        $mesa->nombre = $request['nombre'];
        $mesa->inscritos = $request['inscritos'];
        $mesa->recinto_id = $request['recinto_id'];
        $mesa->save();

        return redirect('mesas');
    }

    public function edit($id)
    {
        return view('vistas.mesas.edit',
            [
                'mesa' => Mesa::findOrFail($id),
                'recintos' => Recinto::all(),
            ]);
    }


    public function update(Request $request, $id)
    {
        $mesa = Mesa::findOrFail($id);
        $mesa->nombre = $request['nombre'];
        $mesa->inscritos = $request['inscritos'];
        $mesa->recinto_id = $request['recinto_id'];
        $mesa->update();

        return redirect('mesas');
    }


    public function destroy($id)
    {
        $mesa = Mesa::findOrFail($id);
        $mesa->delete();

        return redirect('mesas');
    }
}
