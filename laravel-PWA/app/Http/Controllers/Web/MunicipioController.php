<?php

namespace App\Http\Controllers\Web;

use App\Provincia;
use App\Municipio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MunicipioController extends Controller
{
    public function index()
    {
        return view('vistas.municipios.index',
            [
                'municipios' => Municipio::paginate(10),
            ]);
    }

    public function create()
    {
        return view('vistas.municipios.create',
            [
                'provincias' => Provincia::all(),
            ]);
    }


    public function store(Request $request)
    {
        $municipio = new Municipio();
        $municipio->nombre = $request['nombre'];
        $municipio->provincia_id = $request['provincia_id'];
        $municipio->save();

        return redirect('admin/municipios');
    }

    public function edit($id)
    {
        return view('vistas.municipios.edit',
            [
                'municipio' => Municipio::findOrFail($id),
                'provincias' => Provincia::all(),
            ]);
    }


    public function update(Request $request, $id)
    {
        $municipio = Municipio::findOrFail($id);
        $municipio->nombre = $request['nombre'];
        $municipio->provincia_id = $request['provincia_id'];
        $municipio->update();

        return redirect('admin/municipios');
    }


    public function destroy($id)
    {
        $municipio = Municipio::findOrFail($id);
        $municipio->delete();

        return redirect('admin/municipios');
    }
}
