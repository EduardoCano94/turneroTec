@extends('layouts.app')

@section('content')
<main>
    <fieldset>
        <legend>Editar Trámite: {{ $tramite->nombre }}</legend>

        @if ($errors->any())
            <div class="alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tramites.update', $tramite->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nombre">Nombre del Trámite *</label>
            <input type="text" 
                   id="nombre"
                   name="nombre" 
                   value="{{ old('nombre', $tramite->nombre) }}" 
                   required 
                   placeholder="Ej: Renovación de Licencia">

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion"
                      name="descripcion" 
                      rows="4" 
                      placeholder="Describe el trámite en detalle...">{{ old('descripcion', $tramite->descripcion) }}</textarea>
            <small>Opcional: Información adicional sobre el trámite</small>

            <label for="costo">Costo *</label>
            <input type="number" 
                   id="costo"
                   name="costo" 
                   value="{{ old('costo', $tramite->costo) }}" 
                   step="0.01" 
                   min="0" 
                   required
                   placeholder="0.00">
            <small>Costo en pesos mexicanos</small>

            <label for="tiempo_estimado">Tiempo Estimado (minutos) *</label>
            <input type="number" 
                   id="tiempo_estimado"
                   name="tiempo_estimado" 
                   value="{{ old('tiempo_estimado', $tramite->tiempo_estimado) }}" 
                   min="1" 
                   required
                   placeholder="15">
            <small>Duración aproximada en minutos</small>

            <label>
                <input type="checkbox" 
                       id="activo"
                       name="activo" 
                       value="1" 
                       {{ old('activo', $tramite->activo) ? 'checked' : '' }}>
                Trámite activo
            </label>
            <small>Los trámites activos están disponibles para asignar a turnos</small>

           
            <div class="info-box">
                <h4>📊 Información del Trámite</h4>
                <div class="info-row">
                    <label>ID:</label>
                    <span>{{ $tramite->id }}</span>
                </div>
                <div class="info-row">
                    <label>Creado:</label>
                    <span>{{ $tramite->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="info-row">
                    <label>Última actualización:</label>
                    <span>{{ $tramite->updated_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="info-row">
                    <label>Turnos asociados:</label>
                    <span><strong>{{ $tramite->turnos()->count() }}</strong></span>
                </div>
            </div>

            @if($tramite->turnos()->count() > 0)
                <div class="alert-warning">
                    <strong>⚠️ Advertencia:</strong> Este trámite tiene {{ $tramite->turnos()->count() }} turno(s) asociado(s). 
                    Los cambios afectarán a todos los turnos existentes.
                </div>
            @endif

            <div class="alert-success">
                <strong>ℹ️ Nota:</strong> Los campos marcados con * son obligatorios
            </div>

            <input type="submit" value="💾 Actualizar Trámite">

            <div class="button-container">
                <a href="{{ route('tramites.show', $tramite->id) }}" class="btn-action">👁️ Ver Trámite</a>
                <a href="{{ route('tramites.index') }}" class="btn-action">❌ Cancelar</a>
            </div>
        </form>
    </fieldset>
</main>
@endsection