@extends('layouts.app')

@section('content')
<main>
    <fieldset>
        <legend>Borrar Ciudadano</legend>
        <p>Selecciona el ciudadano que deseas eliminar:</p>

        @if(session('success'))
            <div style="color: green; font-weight: bold; margin-bottom: 10px;">
                {{ session('success') }}
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
                                <td>{{ $ciudadano->nombre }}</td>
                                <td>{{ $ciudadano->apellido }}</td>
                                <td>{{ $ciudadano->clave_identificacion }}</td>
                                <td>
                                    {{-- 🔥 ESTE ES EL FORMULARIO CORRECTO --}}
                                    <form action="{{ route('ciudadanos.destroy', $ciudadano->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('¿Seguro que deseas eliminar este ciudadano?')"
                                            style="background-color: #dc2626; color: white; border: none; border-radius: 6px; padding: 6px 12px; cursor: pointer;">
                                            🗑️ Borrar
                                        </button>
                                    </form>
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
