@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Nuevo Turno</h2>

    <form action="{{ route('turnos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Fecha</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Usuario</label>
            <select name="usuario_id" class="form-select" required>
                <option value="">Seleccione</option>
                @foreach($usuarios as $u)
                    <option value="{{ $u->id }}">{{ $u->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Trámite</label>
            <select name="tramite_id" class="form-select" required>
                <option value="">Seleccione</option>
                @foreach($tramites as $t)
                    <option value="{{ $t->id }}">{{ $t->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Ciudadano</label>
            <select name="ciudadano_id" class="form-select" required>
                <option value="">Seleccione</option>
                @foreach($ciudadanos as $c)
                    <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-select" required>
                <option value="EN_ESPERA">EN ESPERA</option>
                <option value="YA_ATENDIDO">YA ATENDIDO</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('turnos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
