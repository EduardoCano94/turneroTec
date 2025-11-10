@extends('layouts.app')

@section('content')
<main>
    <fieldset>
        <legend>Editar Turno #{{ $turno->numero }}</legend>

        @if ($errors->any())
            <div style="color: red; background-color: #fee; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('turnos.update', $turno->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Número de Turno</label>
                <input type="number" 
                       name="numero" 
                       class="form-control" 
                       value="{{ old('numero', $turno->numero) }}" 
                       required>
            </div>

            <div class="mb-3">
                <label>Fecha</label>
                <input type="date" 
                       name="fecha" 
                       class="form-control" 
                       value="{{ old('fecha', $turno->fecha) }}" 
                       required>
            </div>

            <div class="mb-3">
                <label>Descripción del Trámite</label>
                <textarea name="descripcion" 
                          class="form-control" 
                          rows="4" 
                          required 
                          placeholder="Describe el trámite a realizar...">{{ old('descripcion', $turno->descripcion) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Estado</label>
                <select name="estado" class="form-select" required>
                    <option value="En espera" {{ old('estado', $turno->estado) == 'En espera' ? 'selected' : '' }}>
                        ⏳ En espera
                    </option>
                    <option value="Ya atendido" {{ old('estado', $turno->estado) == 'Ya atendido' ? 'selected' : '' }}>
                        ✅ Ya atendido
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label>Ciudadano</label>
                <select name="id_ciudadano" class="form-select" required>
                    <option value="">Seleccione un ciudadano</option>
                    @foreach($ciudadanos as $ciudadano)
                        <option value="{{ $ciudadano->id }}" 
                                {{ old('id_ciudadano', $turno->id_ciudadano) == $ciudadano->id ? 'selected' : '' }}>
                            {{ $ciudadano->nombre }} {{ $ciudadano->apellido }} - {{ $ciudadano->clave_identificacion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="button-container">
                <button type="submit" class="btn-action btn-add">💾 Actualizar Turno</button>
                <a href="{{ route('turnos.show', $turno->id) }}" class="btn-action">👁️ Ver Turno</a>
                <a href="{{ route('turnos.index') }}" class="btn-action">❌ Cancelar</a>
            </div>
        </form>
    </fieldset>
</main>
@endsection