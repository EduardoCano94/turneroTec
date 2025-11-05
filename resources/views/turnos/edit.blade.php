@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Turno #{{ $turno->id }}</h2>

    <form action="{{ route('turnos.update', $turno) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ $turno->fecha }}" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" required>{{ $turno->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label>Usuario</label>
            <select name="usuario_id" class="form-select" required>
                @foreach($usuarios as $u)
                    <option value="{{ $u->id }}" @if($u->id == $turno->usuario_id) selected @endif>{{ $u->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Trámite</label>
            <select name="tramite_id" class="form-select" required>
                @foreach($tramites as $t)
                    <option value="{{ $t->id }}" @if($t->id == $turno->tramite_id) selected @endif>{{ $t->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Ciudadano</label>
            <select name="ciudadano_id" class="form-select" required>
                @foreach($ciudadanos as $c)
                    <option value="{{ $c->id }}" @if($c->id == $turno->ciudadano_id) selected @endif>{{ $c->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-select" required>
                <option value="EN_ESPERA" @if($turno->estado == 'EN_ESPERA') selected @endif>EN ESPERA</option>
                <option value="YA_ATENDIDO" @if($turno->estado == 'YA_ATENDIDO') selected @endif>YA ATENDIDO</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar cambios</button>
        <a href="{{ route('turnos.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
