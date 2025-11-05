@extends('layouts.app')

@section('content')
<main>
    <fieldset>
        <legend>Lista de Ciudadanos</legend>
        <p>Estos son los ciudadanos registrados:</p>

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
                                    {{-- 🔹 Botón de editar con ID en minúsculas --}}
                                    <a href="{{ route('ciudadanos.edit', $ciudadano->id) }}" class="btn-action btn-edit">
                                        ✏️ Editar
                                    </a>
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
