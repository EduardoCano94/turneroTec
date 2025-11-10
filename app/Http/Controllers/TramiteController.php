<?php

namespace App\Http\Controllers;

use App\Models\Tramite;
use Illuminate\Http\Request;

class TramiteController extends Controller
{
    // Listar todos los trámites
    public function index()
    {
        $tramites = Tramite::orderBy('nombre', 'asc')->get();
        return view('tramites.index', compact('tramites'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('tramites.create');
    }

    // Guardar nuevo trámite
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'costo' => 'required|numeric|min:0',
            'tiempo_estimado' => 'required|integer|min:1',
            'activo' => 'boolean',
        ]);

        Tramite::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'costo' => $request->costo,
            'tiempo_estimado' => $request->tiempo_estimado,
            'activo' => $request->has('activo') ? true : false,
        ]);

        return redirect()->route('tramites.index')
                         ->with('success', 'Trámite registrado correctamente.');
    }

    // Mostrar un trámite específico
    public function show($id)
    {
        $tramite = Tramite::with('turnos.ciudadano')->findOrFail($id);
        return view('tramites.show', compact('tramite'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $tramite = Tramite::findOrFail($id);
        return view('tramites.edit', compact('tramite'));
    }

    // Actualizar trámite
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'costo' => 'required|numeric|min:0',
            'tiempo_estimado' => 'required|integer|min:1',
            'activo' => 'boolean',
        ]);

        $tramite = Tramite::findOrFail($id);
        $tramite->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'costo' => $request->costo,
            'tiempo_estimado' => $request->tiempo_estimado,
            'activo' => $request->has('activo') ? true : false,
        ]);

        return redirect()->route('tramites.index')
                         ->with('success', 'Trámite actualizado correctamente.');
    }

    // Eliminar trámite
    public function destroy($id)
    {
        $tramite = Tramite::findOrFail($id);
        
        // Verificar si tiene turnos asociados
        if ($tramite->turnos()->count() > 0) {
            return redirect()->route('tramites.index')
                             ->with('error', 'No se puede eliminar el trámite porque tiene turnos asociados.');
        }
        
        $tramite->delete();

        return redirect()->route('tramites.index')
                         ->with('success', 'Trámite eliminado correctamente.');
    }

    // Vista para buscar trámite
    public function buscarVista()
    {
        return view('tramites.buscar');
    }

    // Buscar trámite por nombre
    public function buscarTramite(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);

        $nombre = $request->input('nombre');

        $tramites = Tramite::where('nombre', 'like', '%' . $nombre . '%')->get();

        if ($tramites->isNotEmpty()) {
            return view('tramites.resultados', compact('tramites', 'nombre'));
        } else {
            return back()->with('error', 'No se encontraron trámites con ese nombre.');
        }
    }

    // Vista para eliminar trámites
    public function deleteView()
    {
        $tramites = Tramite::all();
        return view('tramites.delete', compact('tramites'));
    }
}