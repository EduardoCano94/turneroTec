@extends('layouts.app')

@section('content')
<main>
    <fieldset>
        <legend>Lista de Turnos</legend>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Formulario de filtros --}}
        <form method="GET" action="{{ route('turnos.index') }}" class="filter-form">
            <label for="fecha">Filtrar por Fecha:</label>
            <input type="date" 
                   id="fecha" 
                   name="fecha" 
                   value="{{ request('fecha') }}">

            <label for="estado">Filtrar por Estado:</label>
            <select id="estado" name="estado">
                <option value="">Todos los estados</option>
                <option value="En espera" {{ request('estado') == 'En espera' ? 'selected' : '' }}>En espera</option>
                <option value="Ya atendido" {{ request('estado') == 'Ya atendido' ? 'selected' : '' }}>Ya atendido</option>
            </select>

            <div class="button-container">
                <button type="submit" class="btn-action">🔍 Filtrar</button>
                <a href="{{ route('turnos.index') }}" class="btn-action">🔄 Limpiar</a>
            </div>
        </form>

        @if($turnos->isEmpty())
            <div class="empty-state">
                <p>No hay turnos registrados{{ request('fecha') || request('estado') ? ' con los filtros seleccionados' : '' }}.</p>
            </div>
        @else
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Fecha</th>
                            <th>Ciudadano</th>
                            <th>Clave ID</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($turnos as $turno)
                            <tr>
                                <td><strong>{{ $turno->numero }}</strong></td>
                                <td>{{ \Carbon\Carbon::parse($turno->fecha)->format('d/m/Y') }}</td>
                                <td>{{ $turno->ciudadano->nombre }} {{ $turno->ciudadano->apellido }}</td>
                                <td>{{ $turno->ciudadano->clave_identificacion }}</td>
                                <td>
                                    <div class="text-truncate" title="{{ $turno->descripcion }}">
                                        {{ $turno->descripcion }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge {{ $turno->estado == 'En espera' ? 'badge-warning' : 'badge-success' }}">
                                        {{ $turno->estado }}
                                    </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        {{-- Ver detalle --}}
                                        <a href="{{ route('turnos.show', $turno->id) }}" 
                                           class="btn-action btn-edit"
                                           title="Ver detalle">
                                            👁️ Ver
                                        </a>

                                        {{-- Editar --}}
                                        <a href="{{ route('turnos.edit', $turno->id) }}" 
                                           class="btn-action btn-edit"
                                           title="Editar turno">
                                            ✏️ Editar
                                        </a>

                                        {{-- Cambiar estado --}}
                                        <form action="{{ route('turnos.cambiarEstado', $turno->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" 
                                                    class="btn-action {{ $turno->estado == 'En espera' ? 'btn-add' : 'btn-edit' }}"
                                                    title="Cambiar estado"
                                                    onclick="return confirm('¿Cambiar el estado de este turno?')">
                                                {{ $turno->estado == 'En espera' ? '✅ Atender' : '⏳ Pendiente' }}
                                            </button>
                                        </form>

                                        {{-- Eliminar --}}
                                        <form action="{{ route('turnos.destroy', $turno->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('¿Seguro que deseas eliminar este turno?')"
                                                    class="btn-action btn-delete"
                                                    title="Eliminar turno">
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
            
            <div class="info-box">
                <div class="info-row">
                    <label>Total de turnos:</label>
                    <span><strong>{{ $turnos->count() }}</strong></span>
                </div>
                <div class="info-row">
                    <label>En espera:</label>
                    <span class="badge badge-warning">{{ $turnos->where('estado', 'En espera')->count() }}</span>
                </div>
                <div class="info-row">
                    <label>Atendidos:</label>
                    <span class="badge badge-success">{{ $turnos->where('estado', 'Ya atendido')->count() }}</span>
                </div>
            </div>
        @endif

        <div class="button-container">
            <a href="{{ route('turnos.create') }}" class="btn-action btn-add">
                ➕ Crear Nuevo Turno
            </a>
            <a href="{{ route('dashboard') }}" class="btn-action">
                🏠 Volver al Menú Principal
            </a>
        </div>
    </fieldset>
</main>
@endsection