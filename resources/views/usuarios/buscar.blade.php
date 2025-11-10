@extends('layouts.app')
@section('content')
<main>
    <fieldset>
        <legend>Buscar Usuario</legend>
        
        @if(session('error'))
            <div class="alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        <form action="{{ route('usuarios.buscar.post') }}" method="POST">
            @csrf
            
            <label for="busqueda">Nombre, Apellido o Email del Usuario:</label>
            <input type="text" 
                   id="busqueda" 
                   name="busqueda" 
                   placeholder="Ej: Juan, Pérez o correo@ejemplo.com" 
                   required>
            
            <input type="submit" value="🔍 Buscar">
        </form>
        
        <div class="button-container">
            <a href="{{ route('dashboard') }}" class="btn-action">← Volver al Menú</a>
        </div>
    </fieldset>
</main>
@endsection