<?php

namespace App\Http\Controllers\Web;

use App\Partido;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartidoController extends Controller
{
    public function index()
    {
        return view('vistas.partidos.index',
            [
                'partidos' => Partido::paginate(10),
            ]);
    }

    public function create()
    {
        return view('vistas.partidos.create');
    }


    public function store(Request $request)
    {
        $partido = new Partido();
        $partido->nombre = $request['nombre'];
        $partido->sigla = $request['sigla'];
        $partido->color = $request['color'];
        $partido->save();

        return redirect('admin/partidos');
    }

    public function edit($id)
    {
        return view('vistas.partidos.edit',
            [
                'partido' => Partido::findOrFail($id),
            ]);
    }


    public function update(Request $request, $id)
    {
        $partido = Partido::findOrFail($id);
        $partido->nombre = $request['nombre'];
        $partido->sigla = $request['sigla'];
        $partido->color = $request['color'];
        $partido->update();

        return redirect('admin/partidos');
    }


    public function destroy($id)
    {
        $partido = Partido::findOrFail($id);
        $partido->delete();

        return redirect('admin/partidos');
    }
}
