@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Lista de Turnos</h2>

    <a href="{{ route('turnos.create') }}" class="btn btn-primary mb-3">Nuevo Turno</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Usuario</th>
                <th>Trámite</th>
                <th>Ciudadano</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($turnos as $turno)
                <tr>
                    <td>{{ $turno->id }}</td>
                    <td>{{ $turno->fecha }}</td>
                    <td>{{ $turno->descripcion }}</td>
                    <td>{{ $turno->usuario->nombre ?? '—' }}</td>
                    <td>{{ $turno->tramite->nombre ?? '—' }}</td>
                    <td>{{ $turno->ciudadano->nombre ?? '—' }}</td>
                    <td>{{ $turno->estado }}</td>
                    <td>
                        <a href="{{ route('turnos.edit', $turno) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('turnos.destroy', $turno) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este turno?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8">No hay turnos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
