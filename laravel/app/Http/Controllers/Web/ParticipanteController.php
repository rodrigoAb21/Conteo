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
        $eleccion = new Participante();
        $eleccion->nombre = $request['nombre'];
        $eleccion->color = $request['color'];
        $eleccion->save();

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
        $eleccion = Participante::findOrFail($id);
        $eleccion->nombre = $request['nombre'];
        $eleccion->color = $request['color'];
        $eleccion->update();

        return redirect('participantes');
    }


    public function destroy($id)
    {
        $eleccion = Participante::findOrFail($id);
        $eleccion->delete();

        return redirect('participantes');
    }
}
