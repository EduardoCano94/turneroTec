@extends('layouts.app')

@section('content')
<main>
    <fieldset>
        <legend>Detalle del Turno #{{ $turno->numero }}</legend>

        <div class="details-grid">
            
            {{-- Información del Turno --}}
            <div class="detail-card">
                <h3 class="card-title card-title-primary">📋 Información del Turno</h3>
                
                <div class="info-row">
                    <label>Número:</label>
                    <span class="turno-number">{{ $turno->numero }}</span>
                </div>

                <div class="info-row">
                    <label>Fecha:</label>
                    <span>{{ \Carbon\Carbon::parse($turno->fecha)->format('d/m/Y') }}</span>
                </div>

                <div class="info-row">
                    <label>Estado:</label>
                    <span class="badge {{ $turno->estado == 'En espera' ? 'badge-warning' : 'badge-success' }}">
                        {{ $turno->estado == 'En espera' ? '⏳' : '✅' }} {{ $turno->estado }}
                    </span>
                </div>

                <div class="info-row">
                    <label>Creado:</label>
                    <span>{{ $turno->created_at->format('d/m/Y H:i') }}</span>
                </div>

                @if($turno->updated_at != $turno->created_at)
                    <div class="info-row">
                        <label>Última actualización:</label>
                        <span>{{ $turno->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                @endif
            </div>

            {{-- Información del Ciudadano --}}
            <div class="detail-card">
                <h3 class="card-title card-title-success">👤 Información del Ciudadano</h3>
                
                <div class="info-row">
                    <label>Nombre completo:</label>
                    <span><strong>{{ $turno->ciudadano->nombre }} {{ $turno->ciudadano->apellido }}</strong></span>
                </div>

                <div class="info-row">
                    <label>Clave de Identificación:</label>
                    <span class="code-badge">{{ $turno->ciudadano->clave_identificacion }}</span>
                </div>

                <div class="info-row">
                    <label>ID Ciudadano:</label>
                    <span>{{ $turno->ciudadano->id }}</span>
                </div>
            </div>

            {{-- Descripción del Trámite --}}
            <div class="detail-card detail-card-full">
                <h3 class="card-title card-title-warning">📝 Descripción del Trámite</h3>
                
                <div class="alert-warning">
                    <p style="margin: 0; white-space: pre-wrap;">{{ $turno->descripcion }}</p>
                </div>
            </div>

        </div>

        {{-- Acciones --}}
        <div class="actions-card">
            <h3>⚡ Acciones Rápidas</h3>
            
            <div class="button-container">
                {{-- Cambiar Estado --}}
                <form action="{{ route('turnos.cambiarEstado', $turno->id) }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="btn-action {{ $turno->estado == 'En espera' ? 'btn-add' : 'btn-edit' }}"
                            onclick="return confirm('¿Cambiar el estado de este turno?')">
                        {{ $turno->estado == 'En espera' ? '✅ Marcar como Atendido' : '⏳ Marcar como Pendiente' }}
                    </button>
                </form>

                {{-- Editar --}}
                <a href="{{ route('turnos.edit', $turno->id) }}" class="btn-action btn-edit">
                    ✏️ Editar Turno
                </a>

                {{-- Eliminar --}}
                <form action="{{ route('turnos.destroy', $turno->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('¿Estás seguro de eliminar este turno? Esta acción no se puede deshacer.')"
                            class="btn-action btn-delete">
                        🗑️ Eliminar Turno
                    </button>
                </form>

                {{-- Volver --}}
                <a href="{{ route('turnos.index') }}" class="btn-action">
                    ← Volver a la Lista
                </a>
            </div>
        </div>
    </fieldset>
</main>
@endsection