@extends('layouts.app')

@section('content')
<main>
    <fieldset>
        <legend>Borrar Trámite</legend>
        <p>Selecciona el trámite que deseas eliminar:</p>

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

        @if($tramites->isEmpty())
            <div class="empty-state">
                <p>No hay trámites registrados.</p>
            </div>
        @else
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Costo</th>
                            <th>Tiempo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tramites as $tramite)
                            <tr>
                                <td>{{ $tramite->id }}</td>
                                <td><strong>{{ $tramite->nombre }}</strong></td>
                                <td>${{ number_format($tramite->costo, 2) }}</td>
                                <td>{{ $tramite->tiempo_estimado }} min</td>
                                <td>
                                    <span class="badge {{ $tramite->activo ? 'badge-success' : 'badge-danger' }}">
                                        {{ $tramite->activo ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <form action="{{ route('tramites.destroy', $tramite->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn-action btn-delete"
                                                    onclick="return confirm('¿Seguro que deseas eliminar este trámite?\n\nTiene {{ $tramite->turnos()->count() }} turno(s) asociado(s).')">
                                                🗑️ Borrar
                                            </button>
                                        </form>
                                    </div>
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