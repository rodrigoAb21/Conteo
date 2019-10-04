<?php

namespace App\Http\Controllers\Web;

use App\Participante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParticipanteController extends Controller
{
    public function index()
    {
        return view('vistas.participantes.index',
            [
                'participantes' => Participante::paginate(10),
            ]);
    }

    public function create()
    {
        return view('vistas.participantes.create');
    }


    public function store(Request $request)
    {
        $participante = new Participante();
        $participante->nombre = $request['nombre'];
        $participante->sigla = $request['sigla'];
        $participante->color = $request['color'];
        $participante->save();

        return redirect('admin/participantes');
    }

    public function edit($id)
    {
        return view('vistas.participantes.edit',
            [
                'participante' => Participante::findOrFail($id),
            ]);
    }


    public function update(Request $request, $id)
    {
        $participante = Participante::findOrFail($id);
        $participante->nombre = $request['nombre'];
        $participante->sigla = $request['sigla'];
        $participante->color = $request['color'];
        $participante->update();

        return redirect('admin/participantes');
    }


    public function destroy($id)
    {
        $participante = Participante::findOrFail($id);
        $participante->delete();

        return redirect('admin/participantes');
    }
}
