<?php

namespace App\Http\Controllers;

use App\Models\Ciudadano;
use Illuminate\Http\Request;

class CiudadanoController extends Controller
{
    public function index()
    {
        $ciudadanos = Ciudadano::all();
        return view('ciudadanos.index', compact('ciudadanos'));
    }

    public function create()
    {
        return view('ciudadanos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'clave_identificacion' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (Ciudadano::where('clave_identificacion', $value)->exists()) {
                        $fail('La clave de identificación ya está registrada.');
                    }
                },
            ],
        ]);

        Ciudadano::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'clave_identificacion' => $request->clave_identificacion,
        ]);

        return redirect()->route('ciudadanos.index')
                         ->with('success', 'Ciudadano registrado correctamente.');
    }

    public function buscarVista()
    {
        return view('ciudadanos.buscar');
    }

    public function buscarCiudadano(Request $request)
    {
        $request->validate([
            'claveIdentificacion' => 'required|string',
        ]);

        $clave = $request->input('claveIdentificacion');

        $ciudadano = Ciudadano::where('clave_identificacion', $clave)->first();

        if ($ciudadano) {
            return view('ciudadanos.resultado', compact('ciudadano'));
        } else {
            return back()->with('error', 'No se encontró ningún ciudadano con esa clave de identificación.');
        }
    }

    public function edit($id)
{
    $ciudadano = Ciudadano::findOrFail($id);
    return view('ciudadanos.edit', compact('ciudadano'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'clave_identificacion' => 'required|string|max:255|unique:ciudadano,clave_identificacion,' . $id . ',id',
    ]);

    $ciudadano = Ciudadano::findOrFail($id);
    $ciudadano->update([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'clave_identificacion' => $request->clave_identificacion,
    ]);

    return redirect()->route('ciudadanos.index')->with('success', 'Ciudadano actualizado correctamente.');
}
public function destroy($id)
{
    $ciudadano = Ciudadano::findOrFail($id);
    $ciudadano->delete();

    return redirect()->route('ciudadanos.deleteView')
                     ->with('success', 'Ciudadano eliminado correctamente.');
}

public function deleteView()
{
    $ciudadanos = Ciudadano::all();
    return view('ciudadanos.delete', compact('ciudadanos'));
}



}
