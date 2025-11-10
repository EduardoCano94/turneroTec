@extends('layouts.app')

@section('content')
<main>
    <fieldset>
        <legend>Agregar Nuevo Trámite</legend>

        @if ($errors->any())
            <div style="color: red; background-color: #fee; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tramites.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nombre" style="display: block; margin-bottom: 5px; font-weight: 500;">Nombre del Trámite *</label>
                <input type="text" 
                       id="nombre"
                       name="nombre" 
                       class="form-control" 
                       value="{{ old('nombre') }}" 
                       required 
                       placeholder="Ej: Renovación de Licencia"
                       style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            </div>

            <div class="mb-3">
                <label for="descripcion" style="display: block; margin-bottom: 5px; font-weight: 500;">Descripción</label>
                <textarea id="descripcion"
                          name="descripcion" 
                          class="form-control" 
                          rows="4" 
                          placeholder="Describe el trámite en detalle..."
                          style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">{{ old('descripcion') }}</textarea>
                <small style="color: #6b7280; font-size: 13px;">Opcional: Información adicional sobre el trámite</small>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                <div class="mb-3">
                    <label for="costo" style="display: block; margin-bottom: 5px; font-weight: 500;">Costo *</label>
                    <div style="display: flex; align-items: center; border: 1px solid #ddd; border-radius: 4px; overflow: hidden;">
                        <span style="background-color: #f3f4f6; padding: 8px 12px; border-right: 1px solid #ddd; font-weight: 600;">$</span>
                        <input type="number" 
                               id="costo"
                               name="costo" 
                               class="form-control" 
                               value="{{ old('costo', '0.00') }}" 
                               step="0.01" 
                               min="0" 
                               required
                               placeholder="0.00"
                               style="border: none; padding: 8px; flex: 1; outline: none;">
                    </div>
                    <small style="color: #6b7280; font-size: 13px;">Costo en pesos mexicanos</small>
                </div>

                <div class="mb-3">
                    <label for="tiempo_estimado" style="display: block; margin-bottom: 5px; font-weight: 500;">Tiempo Estimado *</label>
                    <div style="display: flex; align-items: center; border: 1px solid #ddd; border-radius: 4px; overflow: hidden;">
                        <input type="number" 
                               id="tiempo_estimado"
                               name="tiempo_estimado" 
                               class="form-control" 
                               value="{{ old('tiempo_estimado', '15') }}" 
                               min="1" 
                               required
                               placeholder="15"
                               style="border: none; padding: 8px; flex: 1; outline: none;">
                        <span style="background-color: #f3f4f6; padding: 8px 12px; border-left: 1px solid #ddd; font-weight: 600;">min</span>
                    </div>
                    <small style="color: #6b7280; font-size: 13px;">Duración aproximada en minutos</small>
                </div>
            </div>

            <div class="mb-3" style="margin-bottom: 20px;">
                <label style="display: flex; align-items: center; cursor: pointer; user-select: none;">
                    <input type="checkbox" 
                           id="activo"
                           name="activo" 
                           value="1" 
                           {{ old('activo', true) ? 'checked' : '' }}
                           style="width: 18px; height: 18px; margin-right: 8px; cursor: pointer;">
                    <span style="font-weight: 500;">Trámite activo</span>
                </label>
                <small style="color: #6b7280; font-size: 13px; margin-left: 26px;">
                    Los trámites activos están disponibles para asignar a turnos
                </small>
            </div>

            <div style="background-color: #eff6ff; padding: 15px; border-radius: 6px; border-left: 4px solid #3b82f6; margin-bottom: 20px;">
                <p style="margin: 0; color: #1e40af; font-size: 14px;">
                    <strong>ℹ️ Nota:</strong> Los campos marcados con * son obligatorios
                </p>
            </div>

            <div class="button-container" style="display: flex; gap: 10px; justify-content: center;">
                <button type="submit" 
                        style="background-color: #10b981; color: white; border: none; border-radius: 6px; padding: 10px 20px; cursor: pointer; font-weight: 500; transition: all 0.3s;"
                        onmouseover="this.style.backgroundColor='#059669'" 
                        onmouseout="this.style.backgroundColor='#10b981'">
                    💾 Guardar Trámite
                </button>
                <a href="{{ route('tramites.index') }}" 
                   style="background-color: #6b7280; color: white; text-decoration: none; border-radius: 6px; padding: 10px 20px; display: inline-block; font-weight: 500; transition: all 0.3s;"
                   onmouseover="this.style.backgroundColor='#4b5563'" 
                   onmouseout="this.style.backgroundColor='#6b7280'">
                    ❌ Cancelar
                </a>
            </div>
        </form>
    </fieldset>
</main>

<style>
    .mb-3 {
        margin-bottom: 15px;
    }
    
    input[type="text"]:focus,
    input[type="number"]:focus,
    textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
</style>
@endsection