@extends('layouts.app')

@section('content')
<main>
    <header>
        <h1>Bienvenido {{ Auth::user()->email }}</h1>
        <h2>Registro de nuevo ciudadano</h2>
    </header>

    <div class="button-container">
        <a href="{{ route('dashboard') }}">
            <button type="button">Menú Principal</button>
        </a>
    </div>

    <form method="POST" action="{{ route('logout') }}" style="margin-top: 10px;">
        @csrf
        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
    </form>

    <fieldset style="margin-top: 20px;">
        <legend>Datos del Ciudadano</legend>

        @if(session('success'))
            <div id="alerta">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('ciudadanos.store') }}">
            @csrf

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>

            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido" placeholder="Apellido" required>

            <label for="clave_identificacion">Clave de Identificación:</label>
            <input type="text" name="clave_identificacion" id="clave_identificacion" placeholder="Clave de Identificación" required>

            <input type="submit" value="Registrar Ciudadano">
        </form>
    </fieldset>
</main>
@endsection
