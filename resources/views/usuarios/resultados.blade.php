@extends('layouts.app')
@section('content')
<main>
    <fieldset>
        <legend>Resultados de Búsqueda: "{{ $busqueda }}"</legend>
        <p>Se encontraron <strong>{{ $usuarios->count() }}</strong> resultado(s).</p>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Registrado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>
                                <strong>{{ $usuario->nombre }} {{ $usuario->apellido }}</strong>
                                @if($usuario->id == auth()->id())
                                    <span class="badge badge-primary">Tú</span>
                                @endif
                            </td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y') : 'N/A' }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn-action btn-edit">
                                        👁️ Ver
                                    </a>
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn-action btn-edit">
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
            <a href="{{ route('usuarios.buscar') }}" class="btn-action">🔍 Nueva Búsqueda</a>
            <a href="{{ route('usuarios.index') }}" class="btn-action">← Volver a Usuarios</a>
        </div>
    </fieldset>
</main>
@endsection