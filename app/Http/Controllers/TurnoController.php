<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use App\Models\Usuario;
use App\Models\Tramite;
use App\Models\Ciudadano;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    // Mostrar todos los turnos
    public function index()
    {
        $turnos = Turno::with(['usuario','tramite','ciudadano'])->get();
        return view('turnos.index', compact('turnos'));
    }

    // Mostrar formulario para crear
    public function create()
    {
        $usuarios = Usuario::all();
        $tramites = Tramite::all();
        $ciudadanos = Ciudadano::all();

        return view('turnos.create', compact('usuarios','tramites','ciudadanos'));
    }

    // Guardar nuevo turno
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'descripcion' => 'required|string',
            'usuario_id' => 'required|exists:usuario,id',
            'tramite_id' => 'required|exists:tramite,id',
            'ciudadano_id' => 'required|exists:ciudadano,id',
            'estado' => 'required|string'
        ]);

        Turno::create($request->all());

        return redirect()->route('turnos.index')->with('success', 'Turno creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Turno $turno)
    {
        $usuarios = Usuario::all();
        $tramites = Tramite::all();
        $ciudadanos = Ciudadano::all();

        return view('turnos.edit', compact('turno','usuarios','tramites','ciudadanos'));
    }

    // Actualizar turno
    public function update(Request $request, Turno $turno)
    {
        $request->validate([
            'fecha' => 'required|date',
            'descripcion' => 'required|string',
            'usuario_id' => 'required|exists:usuario,id',
            'tramite_id' => 'required|exists:tramite,id',
            'ciudadano_id' => 'required|exists:ciudadano,id',
            'estado' => 'required|string'
        ]);

        $turno->update($request->all());

        return redirect()->route('turnos.index')->with('success', 'Turno actualizado correctamente.');
    }

    // Eliminar turno
    public function destroy(Turno $turno)
    {
        $turno->delete();
        return redirect()->route('turnos.index')->with('success', 'Turno eliminado.');
    }
}
