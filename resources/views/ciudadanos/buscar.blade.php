@extends('layouts.app')

@section('content')
<main>
    <fieldset>
        <legend>Buscar Ciudadano</legend>

        @if (session('error'))
            <div id="alerta">{{ session('error') }}</div>
        @endif

        <form action="{{ route('ciudadanos.buscar.post') }}" method="POST">
            @csrf
            <label for="claveIdentificacion">Clave de Identificación:</label>
            <input type="text" name="claveIdentificacion" id="claveIdentificacion" placeholder="1234567890" required>

            <input type="submit" value="Buscar Ciudadano">
        </form>

        <div class="button-container">
            <a href="{{ route('dashboard') }}" class="btn-action">Volver al Menú</a>
        </div>
    </fieldset>
</main>
@endsection
