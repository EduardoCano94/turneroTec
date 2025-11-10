@extends('layouts.app')
@section('content')
<main>
    <fieldset>
        <legend>Editar Usuario</legend>
        
        @if ($errors->any())
            <div class="alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <label for="nombre">Nombre *</label>
            <input type="text" 
                   id="nombre"
                   name="nombre" 
                   value="{{ old('nombre', $usuario->nombre) }}" 
                   required 
                   placeholder="Ej: Juan">
            
            <label for="apellido">Apellido *</label>
            <input type="text" 
                   id="apellido"
                   name="apellido" 
                   value="{{ old('apellido', $usuario->apellido) }}" 
                   required 
                   placeholder="Ej: Pérez">
            
            <label for="email">Correo Electrónico *</label>
            <input type="email" 
                   id="email"
                   name="email" 
                   value="{{ old('email', $usuario->email) }}" 
                   required 
                   placeholder="ejemplo@correo.com">
            
            <label for="password">Nueva Contraseña (Dejar en blanco para mantener la actual)</label>
            <input type="password" 
                   id="password"
                   name="password" 
                   placeholder="Mínimo 8 caracteres">
            
            <label for="password_confirmation">Confirmar Nueva Contraseña</label>
            <input type="password" 
                   id="password_confirmation"
                   name="password_confirmation" 
                   placeholder="Repite la contraseña">
            
            <div class="alert-success" style="margin-top: 15px;">
                <strong>ℹ️ Nota:</strong> Los campos marcados con * son obligatorios. Si no deseas cambiar la contraseña, deja los campos de contraseña en blanco.
            </div>
            
            <input type="submit" value="💾 Actualizar Usuario">
            
            <div class="button-container">
                <a href="{{ route('usuarios.index') }}" class="btn-action">❌ Cancelar</a>
            </div>
        </form>
    </fieldset>
</main>
@endsection