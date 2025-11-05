@extends('layouts.app')

@section('content')
<main>
    <fieldset>
        <legend>Resultado de la búsqueda</legend>

        <div class="info-row">
            <label>Nombre:</label>
            <span>{{ $ciudadano->nombre }}</span>
        </div>
        <div class="info-row">
            <label>Apellido:</label>
            <span>{{ $ciudadano->apellido }}</span>
        </div>
        <div class="info-row">
            <label>Clave de Identificación:</label>
            <span>{{ $ciudadano->claveIdentificacion }}</span>
        </div>

        <div class="button-container">
            <a href="{{ route('ciudadanos.buscar') }}" class="btn-action">Nueva Búsqueda</a>
            <a href="{{ route('dashboard') }}" class="btn-action">Volver al Menú</a>
        </div>
    </fieldset>
</main>
@endsection
