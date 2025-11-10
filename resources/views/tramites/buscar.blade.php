@extends('layouts.app')

@section('content')
<main>
    <fieldset>
        <legend>Buscar Trámite</legend>

        @if(session('error'))
            <div class="alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('tramites.buscar.post') }}" method="POST">
            @csrf
            
            <label for="nombre">Nombre del Trámite:</label>
            <input type="text" 
                   id="nombre" 
                   name="nombre" 
                   placeholder="Ej: Renovación de Licencia" 
                   required>

            <input type="submit" value="🔍 Buscar">
        </form>

        <div class="button-container">
            <a href="{{ route('dashboard') }}" class="btn-action">← Volver al Menú</a>
        </div>
    </fieldset>
</main>
@endsection