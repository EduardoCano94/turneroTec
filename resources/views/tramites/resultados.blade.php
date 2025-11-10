@extends('layouts.app')

@section('content')
<main>
    <fieldset>
        <legend>Resultados de Búsqueda: "{{ $nombre }}"</legend>

        <p>Se encontraron <strong>{{ $tramites->count() }}</strong> resultado(s).</p>

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
                                    <a href="{{ route('tramites.show', $tramite->id) }}" class="btn-action btn-edit">
                                        👁️ Ver
                                    </a>
                                    <a href="{{ route('tramites.edit', $tramite->id) }}" class="btn-action btn-edit">
                                        ✏️ Editar
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="button-container">
            <a href="{{ route('tramites.buscar') }}" class="btn-action">🔍 Nueva Búsqueda</a>
            <a href="{{ route('dashboard') }}" class="btn-action">← Volver al Menú</a>
        </div>
    </fieldset>
</main>
@endsection