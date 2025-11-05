@extends('layouts.app')

@section('content')
<main>
    <fieldset>
        <legend>Editar Ciudadano</legend>

        <form method="POST" action="{{ route('ciudadanos.update', $ciudadano->id) }}">
            @csrf
            @method('PUT')

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre"
                   value="{{ old('nombre', $ciudadano->nombre) }}" required>

            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido"
                   value="{{ old('apellido', $ciudadano->apellido) }}" required>

            <label for="clave_identificacion">Clave de Identificación:</label>
            <input type="text" name="clave_identificacion" id="clave_identificacion"
                   value="{{ old('clave_identificacion', $ciudadano->clave_identificacion) }}" required>

            <button type="submit"
                    style="background-color: #10b981; color: white; font-weight: bold; border: none;
                           border-radius: 8px; padding: 10px 18px; cursor: pointer; margin-top: 10px;">
                Actualizar Ciudadano
            </button>
        </form>

        <div class="button-container" style="margin-top: 15px;">
            <a href="{{ route('ciudadanos.index') }}" class="btn-action">Volver</a>
        </div>
    </fieldset>
</main>
@endsection
