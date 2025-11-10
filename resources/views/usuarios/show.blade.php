@extends('layouts.app')
@section('content')
<main>
    <fieldset>
        <legend>Detalle del Usuario</legend>
        
        <div class="info-row">
            <label>ID:</label>
            <span>{{ $usuario->id }}</span>
        </div>
        
        <div class="info-row">
            <label>Nombre:</label>
            <span><strong>{{ $usuario->nombre }} {{ $usuario->apellido }}</strong></span>
        </div>
        
        <div class="info-row">
            <label>Email:</label>
            <span>{{ $usuario->email }}</span>
        </div>
        
        <div class="info-row">
            <label>Fecha de Registro:</label>
            <span>{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
        </div>
        
        <div class="info-row">
            <label>Última Actualización:</label>
            <span>{{ $usuario->updated_at ? $usuario->updated_at->format('d/m/Y H:i') : 'N/A' }}</span>
        </div>
        
        <div class="info-row">
            <label>Email Verificado:</label>
            <span>
                @if($usuario->email_verified_at)
                    <span class="badge badge-success">✅ Verificado ({{ $usuario->email_verified_at->format('d/m/Y') }})</span>
                @else
                    <span class="badge badge-warning">⏳ Pendiente</span>
                @endif
            </span>
        </div>
        
        @if($usuario->id == auth()->id())
            <div class="alert-success">
                <strong>👤 Este es tu usuario actual.</strong> Puedes editar tu información desde aquí.
            </div>
        @endif
        
        <div class="button-container">
            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn-action btn-edit">✏️ Editar</a>
            
            @if($usuario->id != auth()->id())
                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn-action btn-delete"
                            onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                        🗑️ Eliminar
                    </button>
                </form>
            @endif
            
            <a href="{{ route('usuarios.index') }}" class="btn-action">← Volver</a>
        </div>
    </fieldset>
</main>
@endsection