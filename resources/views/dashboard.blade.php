@extends('layouts.app')

@section('content')
    <main>
        <fieldset>
            <legend>Bienvenido, {{ Auth::user()->email }}</legend>
            <p>Selecciona una opción:</p>

            <div class="menu-grid">
                <div class="menu-section">
                    <h3>Turnos</h3>
                    <button>Agregar Turno</button>
                    <button>Gestión de Turnos</button>
                    <button>Turnos en Espera</button>
                    <button>Turnos Atendidos</button>
                </div>

                <div class="menu-section">
                    <h3>Ciudadanos</h3>
                    <a href="{{ route('ciudadanos.create') }}" class="btn-action btn-add">Agregar Ciudadano</a>
                    <a href="{{ route('ciudadanos.buscar') }}" class="btn-action">Buscar Ciudadano</a>
                    <a href="{{ route('ciudadanos.index') }}" class="btn-action btn-edit">Editar Ciudadano</a>
                    <a href="{{ route('ciudadanos.deleteView') }}" class="btn-action">Borrar Ciudadano</a>
                 </div>

                <div class="menu-section">
                    <h3>Trámites</h3>
                    <button>Agregar Trámite</button>
                    <button>Buscar Trámite</button>
                    <button>Editar Trámite</button>
                    <button>Borrar Trámite</button>
                </div>

                <div class="menu-section">
                    <h3>Usuarios</h3>
                    <button>Agregar Usuario</button>
                    <button>Buscar Usuario</button>
                    <button>Editar Usuario</button>
                    <button>Borrar Usuario</button>
                </div>
            </div>

            <div class="button-container">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Cerrar sesión</button>
                </form>
            </div>
        </fieldset>
    </main>
@endsection
