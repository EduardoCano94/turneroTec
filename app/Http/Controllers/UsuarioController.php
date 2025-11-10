<?php
namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Listar todos los usuarios
    public function index()
    {
        $usuarios = Usuario::orderBy('created_at', 'desc')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('usuarios.create');
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuario',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario creado correctamente.');
    }

    // Mostrar un usuario específico
    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Actualizar usuario
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuario,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
        ];

        // Solo actualizar la contraseña si se proporciona una nueva
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        
        // No permitir eliminar al usuario actual
        if ($usuario->id == auth()->id()) {
            return redirect()->route('usuarios.index')
                             ->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario eliminado correctamente.');
    }

    // Vista para buscar usuario
    public function buscarVista()
    {
        return view('usuarios.buscar');
    }

    // Buscar usuario por email o nombre
    public function buscarUsuario(Request $request)
    {
        $request->validate([
            'busqueda' => 'required|string',
        ]);

        $busqueda = $request->input('busqueda');
        
        $usuarios = Usuario::where('nombre', 'like', '%' . $busqueda . '%')
                        ->orWhere('apellido', 'like', '%' . $busqueda . '%')
                        ->orWhere('email', 'like', '%' . $busqueda . '%')
                        ->get();

        if ($usuarios->isNotEmpty()) {
            return view('usuarios.resultados', compact('usuarios', 'busqueda'));
        } else {
            return back()->with('error', 'No se encontraron usuarios.');
        }
    }

    // Vista para eliminar usuarios
    public function deleteView()
    {
        $usuarios = Usuario::whereNotNull('created_at')
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('usuarios.delete', compact('usuarios'));
    }
}