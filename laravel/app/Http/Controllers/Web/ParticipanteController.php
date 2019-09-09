<?php

namespace App\Http\Controllers\Web;

use App\Participante;
use App\Utils\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParticipanteController extends Controller
{
    public function index()
    {
        return view('vistas.participantes.index',
            [
                'participantes' => Participante::paginate(10),
                'colores' => Color::getColores(),
            ]);
    }

    public function create()
    {
        return view('vistas.participantes.create',
        [
            'colores' => Color::getColores(),
        ]);
    }


    public function store(Request $request)
    {
        $participante = new Participante();
        $participante->nombre = $request['nombre'];
        $participante->color = $request['color'];
        $participante->save();

        return redirect('participantes');
    }

    public function edit($id)
    {
        return view('vistas.participantes.edit',
            [
                'colores' => Color::getColores(),
                'participante' => Participante::findOrFail($id),
            ]);
    }


    public function update(Request $request, $id)
    {
        $participante = Participante::findOrFail($id);
        $participante->nombre = $request['nombre'];
        $participante->color = $request['color'];
        $participante->update();

        return redirect('participantes');
    }


    public function destroy($id)
    {
        $participante = Participante::findOrFail($id);
        $participante->delete();

        return redirect('participantes');
    }
}
