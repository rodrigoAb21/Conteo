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
            ['participantes' => Participante::paginate(10)]);
    }

    public function create()
    {
        $colores = Color::getColores();

        return view('vistas.participantes.create',
            [
                'colores' => $colores,
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
        $colores = [
            '#2471A3',
            '#C0392B',
            '#9B59B6',
            '#1ABC9C',
            '#27AE60',
            '#F1C40F',
            '#E67E22',
            '#ECF0F1',
            '#AAB7B8',
            '#17202A',
        ];

        return view('vistas.participantes.edit',
            [
                'colores' => $colores,
                'eleccion' => Participante::findOrFail($id),
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
