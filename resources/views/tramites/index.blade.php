@extends('layouts.app')

@section('content')
<main>
    <fieldset>
        <legend>Lista de Trámites</legend>

        @if(session('success'))
            <div style="color: green; font-weight: bold; margin-bottom: 15px; padding: 10px; background-color: #d4edda; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="color: red; font-weight: bold; margin-bottom: 15px; padding: 10px; background-color: #f8d7da; border-radius: 5px;">
                {{ session('error') }}
            </div>
        @endif

        @if($tramites->isEmpty())
            <p style="color: #6b7280; font-weight: 500; text-align: center; padding: 20px;">
                No hay trámites registrados.
            </p>
        @else
            <div class="table-container" style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; background-color: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <thead>
                        <tr style="background-color: #3b82f6; color: white;">
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">ID</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Nombre</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Descripción</th>
                            <th style="padding: 12px; text-align: center; border-bottom: 2px solid #ddd;">Costo</th>
                            <th style="padding: 12px; text-align: center; border-bottom: 2px solid #ddd;">Tiempo Estimado</th>
                            <th style="padding: 12px; text-align: center; border-bottom: 2px solid #ddd;">Estado</th>
                            <th style="padding: 12px; text-align: center; border-bottom: 2px solid #ddd;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tramites as $tramite)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 12px; font-weight: 600; color: #1f2937;">{{ $tramite->id }}</td>
                                <td style="padding: 12px; font-weight: 500;">{{ $tramite->nombre }}</td>
                                <td style="padding: 12px; max-width: 300px;">
                                    <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $tramite->descripcion }}">
                                        {{ $tramite->descripcion ?? 'Sin descripción' }}
                                    </div>
                                </td>
                                <td style="padding: 12px; text-align: center; font-weight: 600; color: #059669;">
                                    ${{ number_format($tramite->costo, 2) }}
                                </td>
                                <td style="padding: 12px; text-align: center;">
                                    <span style="background-color: #dbeafe; color: #1e40af; padding: 4px 8px; border-radius: 4px; font-size: 13px;">
                                        ⏱️ {{ $tramite->tiempo_estimado }} min
                                    </span>
                                </td>
                                <td style="padding: 12px; text-align: center;">
                                    <span style="padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; 
                                        {{ $tramite->activo ? 'background-color: #d1fae5; color: #065f46;' : 'background-color: #fee2e2; color: #991b1b;' }}">
                                        {{ $tramite->activo ? '✅ Activo' : '❌ Inactivo' }}
                                    </span>
                                </td>
                                <td style="padding: 12px;">
                                    <div style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
                                        {{-- Ver detalle --}}
                                        <a href="{{ route('tramites.show', $tramite->id) }}" 
                                           style="background-color: #3b82f6; color: white; text-decoration: none; border-radius: 4px; padding: 6px 10px; font-size: 13px; display: inline-block;"
                                           title="Ver detalle">
                                            👁️ Ver
                                        </a>

                                        {{-- Editar --}}
                                        <a href="{{ route('tramites.edit', $tramite->id) }}" 
                                           style="background-color: #f59e0b; color: white; text-decoration: none; border-radius: 4px; padding: 6px 10px; font-size: 13px; display: inline-block;"
                                           title="Editar trámite">
                                            ✏️ Editar
                                        </a>

                                        {{-- Eliminar --}}
                                        <form action="{{ route('tramites.destroy', $tramite->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('¿Seguro que deseas eliminar este trámite?')"
                                                    style="background-color: #dc2626; color: white; border: none; border-radius: 4px; padding: 6px 10px; cursor: pointer; font-size: 13px;"
                                                    title="Eliminar trámite">
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

            {{-- Resumen --}}
            <div style="margin-top: 20px; padding: 15px; background-color: #f3f4f6; border-radius: 8px; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                <div>
                    <strong>Total de trámites:</strong> {{ $tramites->count() }}
                </div>
                <div>
                    <strong>Activos:</strong> 
                    <span style="color: #065f46;">{{ $tramites->where('activo', true)->count() }}</span>
                </div>
                <div>
                    <strong>Inactivos:</strong> 
                    <span style="color: #991b1b;">{{ $tramites->where('activo', false)->count() }}</span>
                </div>
                <div>
                    <strong>Costo promedio:</strong> 
                    <span style="color: #059669;">${{ number_format($tramites->avg('costo'), 2) }}</span>
                </div>
            </div>
        @endif

        <div class="button-container" style="margin-top: 20px; display: flex; gap: 10px; justify-content: center;">
            <a href="{{ route('tramites.create') }}" 
               style="background-color: #10b981; color: white; text-decoration: none; border-radius: 6px; padding: 10px 20px; font-weight: 500; display: inline-block;">
                ➕ Crear Nuevo Trámite
            </a>
            <a href="{{ route('dashboard') }}" 
               style="background-color: #6b7280; color: white; text-decoration: none; border-radius: 6px; padding: 10px 20px; font-weight: 500; display: inline-block;">
                🏠 Volver al Menú Principal
            </a>
        </div>
    </fieldset>
</main>
@endsection