@extends('layouts.app')
@section('content')
<main>
    <fieldset>
        <legend>Lista de Ciudadanos</legend>
        <p>Estos son los ciudadanos registrados:</p>
        
        @if(session('success'))
            <div style="background-color: #d1fae5; color: #065f46; padding: 12px; border-radius: 0.5rem; margin-bottom: 15px; border: 1px solid #6ee7b7;">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div id="alerta">
                ⚠ {{ session('error') }}
            </div>
        @endif

        @if($ciudadanos->isEmpty())
            <p style="color: #6b7280; font-weight: 500;">No hay ciudadanos registrados.</p>
        @else
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Clave de Identificación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ciudadanos as $ciudadano)
                            <tr>
                                <td>{{ $ciudadano->id }}</td>
                                <td style="color: #2563eb; font-weight: 600;">
                                    {{ $ciudadano->nombre }}
                                </td>
                                <td style="color: #1e40af; font-weight: 600;">
                                    {{ $ciudadano->apellido }}
                                </td>
                                <td style="color: #374151;">
                                    {{ $ciudadano->clave_identificacion }}
                                </td>
                                <td>
                                    <div class="actions">
                                        {{-- Botón de editar --}}
                                        <a href="{{ route('ciudadanos.edit', $ciudadano->id) }}" class="btn-action btn-edit">
                                            ✏️ Editar
                                        </a>
                                        
                                        {{-- Botón de eliminar --}}
                                        <form action="{{ route('ciudadanos.destroy', $ciudadano->id) }}" method="POST" style="display: inline-block; margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" 
                                                    onclick="return confirm('¿Estás seguro de eliminar a {{ $ciudadano->nombre }} {{ $ciudadano->apellido }}?')">
                                                🗑️ Eliminar
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
            <a href="{{ route('ciudadanos.create') }}" class="btn-action btn-add">➕ Agregar Ciudadano</a>
            <a href="{{ route('dashboard') }}" class="btn-action">Volver al Menú Principal</a>
        </div>
    </fieldset>
</main>
@endsection