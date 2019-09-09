<?php

namespace App\Http\Controllers\Web;

use App\Provincia;
use App\Localidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocalidadController extends Controller
{
    public function index()
    {
        return view('vistas.localidades.index',
            [
                'localidades' => Localidad::paginate(10),
            ]);
    }

    public function create()
    {
        return view('vistas.localidades.create',
            [
                'provincias' => Provincia::all(),
            ]);
    }


    public function store(Request $request)
    {
        $localidad = new Localidad();
        $localidad->nombre = $request['nombre'];
        $localidad->provincia_id = $request['provincia_id'];
        $localidad->save();

        return redirect('localidades');
    }

    public function edit($id)
    {
        return view('vistas.localidades.edit',
            [
                'localidad' => Localidad::findOrFail($id),
                'provincias' => Provincia::all(),
            ]);
    }


    public function update(Request $request, $id)
    {
        $localidad = Localidad::findOrFail($id);
        $localidad->nombre = $request['nombre'];
        $localidad->provincia_id = $request['provincia_id'];
        $localidad->update();

        return redirect('localidades');
    }


    public function destroy($id)
    {
        $localidad = Localidad::findOrFail($id);
        $localidad->delete();

        return redirect('localidades');
    }
}
