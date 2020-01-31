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
        $localidad = new Municipio();
        $localidad->nombre = $request['nombre'];
        $localidad->provincia_id = $request['provincia_id'];
        $localidad->save();

        return redirect('admin/municipios');
    }

    public function edit($id)
    {
        return view('vistas.municipios.edit',
            [
                'localidad' => Municipio::findOrFail($id),
                'provincias' => Provincia::all(),
            ]);
    }


    public function update(Request $request, $id)
    {
        $localidad = Municipio::findOrFail($id);
        $localidad->nombre = $request['nombre'];
        $localidad->provincia_id = $request['provincia_id'];
        $localidad->update();

        return redirect('admin/municipios');
    }


    public function destroy($id)
    {
        $localidad = Municipio::findOrFail($id);
        $localidad->delete();

        return redirect('admin/municipios');
    }
}
