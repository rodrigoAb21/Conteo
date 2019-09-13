<?php

namespace App\Http\Controllers\Web;

use App\Pais;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaisController extends Controller
{
    public function index()
    {
        return view('vistas.paises.index',
            [
                'paises' => Pais::paginate(10),
            ]);
    }

    public function create()
    {
        return view('vistas.paises.create');
    }


    public function store(Request $request)
    {
        $eleccion = new Pais();
        $eleccion->nombre = $request['nombre'];
        $eleccion->save();

        return redirect('admin/paises');
    }

    public function edit($id)
    {
        return view('vistas.paises.edit',
            [
                'pais' => Pais::findOrFail($id),
            ]);
    }


    public function update(Request $request, $id)
    {
        $eleccion = Pais::findOrFail($id);
        $eleccion->nombre = $request['nombre'];
        $eleccion->update();

        return redirect('admin/paises');
    }


    public function destroy($id)
    {
        $eleccion = Pais::findOrFail($id);
        $eleccion->delete();

        return redirect('admin/paises');
    }
}
