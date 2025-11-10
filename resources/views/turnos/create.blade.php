@extends('layouts.app')

@section('content')
<main>
    <fieldset>
        <legend>Agregar Nuevo Turno</legend>

        @if ($errors->any())
            <div style="color: red; background-color: #fee; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('turnos.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Número de Turno</label>
                <input type="number" name="numero" class="form-control" value="{{ $nuevoNumero }}" readonly required>
                <small style="color: #6b7280;">Este número se asigna automáticamente</small>
            </div>

            <div class="mb-3">
                <label>Fecha</label>
                <input type="date" name="fecha" class="form-control" value="{{ old('fecha', date('Y-m-d')) }}" required>
            </div>

            {{-- ✨ NUEVO: Selector de Trámite --}}
            <div class="mb-3">
                <label>Tipo de Trámite *</label>
                <select name="tramite_id" id="tramite_id" class="form-select" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    <option value="">Seleccione un trámite</option>
                    @foreach($tramites as $tramite)
                        @if($tramite->activo)
                            <option value="{{ $tramite->id }}" 
                                    data-costo="{{ $tramite->costo }}"
                                    data-tiempo="{{ $tramite->tiempo_estimado }}"
                                    {{ old('tramite_id') == $tramite->id ? 'selected' : '' }}>
                                {{ $tramite->nombre }} - ${{ number_format($tramite->costo, 2) }} - {{ $tramite->tiempo_estimado }} min
                            </option>
                        @endif
                    @endforeach
                </select>
                <small style="color: #6b7280;">Selecciona el servicio que el ciudadano viene a realizar</small>
            </div>

            {{-- Información del trámite seleccionado --}}
            <div id="info-tramite" style="display: none; background-color: #eff6ff; padding: 15px; border-radius: 6px; margin-bottom: 15px; border-left: 4px solid #3b82f6;">
                <h4 style="margin: 0 0 10px 0; color: #1e40af; font-size: 14px;">📋 Información del Trámite</h4>
                <p style="margin: 5px 0;"><strong>Costo:</strong> <span id="tramite-costo">$0.00</span></p>
                <p style="margin: 5px 0;"><strong>Tiempo estimado:</strong> <span id="tramite-tiempo">0 minutos</span></p>
            </div>

            <div class="mb-3">
                <label>Descripción / Notas Adicionales</label>
                <textarea name="descripcion" class="form-control" rows="4" placeholder="Agrega cualquier nota o detalle adicional sobre este turno...">{{ old('descripcion') }}</textarea>
                <small style="color: #6b7280;">Opcional: Información extra sobre el turno</small>
            </div>

            <div class="mb-3">
                <label>Ciudadano *</label>
                <select name="id_ciudadano" class="form-select" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    <option value="">Seleccione un ciudadano</option>
                    @foreach($ciudadanos as $ciudadano)
                        <option value="{{ $ciudadano->id }}" {{ old('id_ciudadano') == $ciudadano->id ? 'selected' : '' }}>
                            {{ $ciudadano->nombre }} {{ $ciudadano->apellido }} - {{ $ciudadano->clave_identificacion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="button-container">
                <button type="submit" class="btn-action btn-add">💾 Guardar Turno</button>
                <a href="{{ route('turnos.index') }}" class="btn-action">❌ Cancelar</a>
            </div>
        </form>
    </fieldset>
</main>

<script>
    // Mostrar información del trámite cuando se selecciona
    document.getElementById('tramite_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const infoDiv = document.getElementById('info-tramite');
        
        if (this.value) {
            const costo = selectedOption.dataset.costo;
            const tiempo = selectedOption.dataset.tiempo;
            
            document.getElementById('tramite-costo').textContent = '$' + parseFloat(costo).toFixed(2);
            document.getElementById('tramite-tiempo').textContent = tiempo + ' minutos';
            
            infoDiv.style.display = 'block';
        } else {
            infoDiv.style.display = 'none';
        }
    });
</script>
@endsection