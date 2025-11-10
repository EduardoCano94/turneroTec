@extends('layouts.app')
@section('content')
<main>
    <fieldset>
        <legend>Agregar Nuevo Usuario</legend>
        @if ($errors->any())
            <div class="alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            
            <label for="nombre">Nombre *</label>
            <input type="text" 
                   id="nombre"
                   name="nombre" 
                   value="{{ old('nombre') }}" 
                   required 
                   placeholder="Ej: Juan">
            
            <label for="apellido">Apellido *</label>
            <input type="text" 
                   id="apellido"
                   name="apellido" 
                   value="{{ old('apellido') }}" 
                   required 
                   placeholder="Ej: Pérez">
            
            <label for="email">Correo Electrónico *</label>
            <input type="email" 
                   id="email"
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   placeholder="ejemplo@correo.com">
            
            <label for="password">Contraseña *</label>
            <input type="password" 
                   id="password"
                   name="password" 
                   required 
                   placeholder="Mínimo 8 caracteres">
            
            <label for="password_confirmation">Confirmar Contraseña *</label>
            <input type="password" 
                   id="password_confirmation"
                   name="password_confirmation" 
                   required 
                   placeholder="Repite la contraseña">
            
            <div class="alert-success" style="margin-top: 15px;">
                <strong>ℹ️ Nota:</strong> Los campos marcados con * son obligatorios. La contraseña debe tener al menos 8 caracteres.
            </div>
            
            <input type="submit" value="💾 Guardar Usuario">
            
            <div class="button-container">
                <a href="{{ route('usuarios.index') }}" class="btn-action">❌ Cancelar</a>
            </div>
        </form>
    </fieldset>
</main>
@endsection