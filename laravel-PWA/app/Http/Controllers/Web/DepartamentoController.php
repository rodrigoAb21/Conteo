<?php

namespace App\Http\Controllers\Web;

use App\Departamento;
use App\Pais;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartamentoController extends Controller
{
    public function index()
    {
        return view('vistas.departamentos.index',
            [
                'departamentos' => Departamento::paginate(10),
            ]);
    }

    public function create()
    {
        return view('vistas.departamentos.create',
            [
                'paises' => Pais::all(),
            ]);
    }


    public function store(Request $request)
    {
        $departamento = new Departamento();
        $departamento->nombre = $request['nombre'];
        $departamento->pais_id = $request['pais_id'];
        $departamento->save();

        return redirect('admin/departamentos');
    }

    public function edit($id)
    {
        return view('vistas.departamentos.edit',
            [
                'departamento' => Departamento::findOrFail($id),
                'paises' => Pais::all(),
            ]);
    }


    public function update(Request $request, $id)
    {
        $departamento = Departamento::findOrFail($id);
        $departamento->nombre = $request['nombre'];
        $departamento->pais_id = $request['pais_id'];
        $departamento->update();

        return redirect('admin/departamentos');
    }


    public function destroy($id)
    {
        $departamento = Departamento::findOrFail($id);
        $departamento->delete();

        return redirect('admin/departamentos');
    }
}
