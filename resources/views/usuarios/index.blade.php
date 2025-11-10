@extends('layouts.app')

@section('content')
<main>
    <fieldset>
        <legend>Lista de Usuarios</legend>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($usuarios->isEmpty())
            <div class="empty-state">
                <p>No hay usuarios registrados.</p>
            </div>
        @else
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>  <!-- ← AGREGAR ESTA LÍNEA -->
                            <th>Email</th>
                            <th>Fecha de Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>
                                    <strong>{{ $usuario->nombre }}</strong>
                                    @if($usuario->id == auth()->id())
                                        <span class="badge badge-primary">Tú</span>
                                    @endif
                                </td>
                                <td>{{ $usuario->apellido }}</td>  <!-- ← AGREGAR ESTA LÍNEA -->
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn-action btn-edit">
                                            👁️ Ver
                                        </a>
                                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn-action btn-edit">
                                            ✏️ Editar
                                        </a>
                                        @if($usuario->id != auth()->id())
                                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn-action btn-delete"
                                                        onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                                    🗑️ Borrar
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="info-row">
                <label>Total de usuarios:</label>
                <span><strong>{{ $usuarios->count() }}</strong></span>
            </div>
        @endif

        <div class="button-container">
            <a href="{{ route('usuarios.create') }}" class="btn-action btn-add">➕ Crear Nuevo Usuario</a>
            <a href="{{ route('dashboard') }}" class="btn-action">🏠 Volver al Menú Principal</a>
        </div>
    </fieldset>
</main>
@endsection