<?php

namespace App\Http\Controllers\Web;

use App\Provincia;
use App\Departamento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProvinciaController extends Controller
{
    public function index()
    {
        return view('vistas.provincias.index',
            [
                'provincias' => Provincia::paginate(10),
            ]);
    }

    public function create()
    {
        return view('vistas.provincias.create',
            [
                'departamentos' => Departamento::all(),
            ]);
    }


    public function store(Request $request)
    {
        $provincia = new Provincia();
        $provincia->nombre = $request['nombre'];
        $provincia->departamento_id = $request['departamento_id'];
        $provincia->save();

        return redirect('admin/provincias');
    }

    public function edit($id)
    {
        return view('vistas.provincias.edit',
            [
                'provincia' => Provincia::findOrFail($id),
                'departamentos' => Departamento::all(),
            ]);
    }


    public function update(Request $request, $id)
    {
        $provincia = Provincia::findOrFail($id);
        $provincia->nombre = $request['nombre'];
        $provincia->departamento_id = $request['departamento_id'];
        $provincia->update();

        return redirect('admin/provincias');
    }


    public function destroy($id)
    {
        $provincia = Provincia::findOrFail($id);
        $provincia->delete();

        return redirect('admin/provincias');
    }
}
