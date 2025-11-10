@extends('layouts.app')
@section('content')
<main>
    <fieldset>
        <legend>Borrar Usuario</legend>
        <p>Selecciona el usuario que deseas eliminar:</p>
        
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
                            <th>Email</th>
                            <th>Registrado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>
                                    <strong>{{ $usuario->nombre }} {{ $usuario->apellido }}</strong>
                                    @if($usuario->id == auth()->id())
                                        <span class="badge badge-primary">Tú</span>
                                    @endif
                                </td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y') : 'N/A' }}</td>
                                <td>
                                    @if($usuario->id == auth()->id())
                                        <span class="badge badge-warning">No puedes eliminar tu propia cuenta</span>
                                    @else
                                        <div class="actions">
                                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn-action btn-delete"
                                                        onclick="return confirm('¿Seguro que deseas eliminar al usuario {{ $usuario->nombre }} {{ $usuario->apellido }}?')">
                                                    🗑️ Borrar
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        
        <div class="button-container">
            <a href="{{ route('dashboard') }}" class="btn-action">Volver al Menú Principal</a>
        </div>
    </fieldset>
</main>
@endsection