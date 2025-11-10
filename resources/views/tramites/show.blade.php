@extends('layouts.app')

@section('content')
<main>
    <fieldset>
        <legend>Detalle del Trámite: {{ $tramite->nombre }}</legend>

        <div class="info-row">
            <label>ID:</label>
            <span>{{ $tramite->id }}</span>
        </div>

        <div class="info-row">
            <label>Nombre:</label>
            <span>{{ $tramite->nombre }}</span>
        </div>

        <div class="info-row">
            <label>Descripción:</label>
            <span>{{ $tramite->descripcion ?? 'Sin descripción' }}</span>
        </div>

        <div class="info-row">
            <label>Costo:</label>
            <span class="badge badge-success">${{ number_format($tramite->costo, 2) }} MXN</span>
        </div>

        <div class="info-row">
            <label>Tiempo Estimado:</label>
            <span class="badge badge-primary">{{ $tramite->tiempo_estimado }} minutos</span>
        </div>

        <div class="info-row">
            <label>Estado:</label>
            <span class="badge {{ $tramite->activo ? 'badge-success' : 'badge-danger' }}">
                {{ $tramite->activo ? '✅ Activo' : '❌ Inactivo' }}
            </span>
        </div>

        <div class="info-row">
            <label>Creado:</label>
            <span>{{ $tramite->created_at->format('d/m/Y H:i') }}</span>
        </div>

        <div class="info-row">
            <label>Última actualización:</label>
            <span>{{ $tramite->updated_at->format('d/m/Y H:i') }}</span>
        </div>

        <div class="info-row">
            <label>Turnos asociados:</label>
            <span><strong>{{ $tramite->turnos()->count() }}</strong> turno(s)</span>
        </div>

        @if($tramite->turnos()->count() > 0)
            <div class="alert-success">
                <strong>📊 Estadísticas:</strong> Este trámite tiene {{ $tramite->turnos()->count() }} turno(s) registrado(s).
            </div>

            <h3>Turnos Asociados</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Fecha</th>
                            <th>Ciudadano</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tramite->turnos as $turno)
                            <tr>
                                <td><strong>{{ $turno->numero }}</strong></td>
                                <td>{{ \Carbon\Carbon::parse($turno->fecha)->format('d/m/Y') }}</td>
                                <td>{{ $turno->ciudadano->nombre }} {{ $turno->ciudadano->apellido }}</td>
                                <td>
                                    <span class="badge {{ $turno->estado == 'En espera' ? 'badge-warning' : 'badge-success' }}">
                                        {{ $turno->estado }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="button-container">
            <a href="{{ route('tramites.edit', $tramite->id) }}" class="btn-action btn-edit">✏️ Editar</a>
            
            <form action="{{ route('tramites.destroy', $tramite->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="btn-action btn-delete"
                        onclick="return confirm('¿Estás seguro de eliminar este trámite?')">
                    🗑️ Eliminar
                </button>
            </form>

            <a href="{{ route('tramites.index') }}" class="btn-action">← Volver</a>
        </div>
    </fieldset>
</main>
@endsection