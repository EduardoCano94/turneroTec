@extends('layouts.app')

@section('content')
    <main>
        <fieldset>
            <legend>Bienvenido, {{ Auth::user()->email }}</legend>
            <p>Selecciona una opción:</p>

            <div class="menu-grid">
                {{-- Sección de Turnos --}}
                <div class="menu-section">
                    <h3>Turnos</h3>
                    <a href="{{ route('turnos.create') }}" class="btn-action btn-add">Agregar Turno</a>
                    <a href="{{ route('turnos.index') }}" class="btn-action btn-edit">Gestión de Turnos</a>
                    <a href="{{ route('turnos.enEspera') }}" class="btn-action">Turnos en Espera</a>
                    <a href="{{ route('turnos.atendidos') }}" class="btn-action">Turnos Atendidos</a>
                </div>

                {{-- Sección de Ciudadanos --}}
                <div class="menu-section">
                    <h3>Ciudadanos</h3>
                    <a href="{{ route('ciudadanos.create') }}" class="btn-action btn-add">Agregar Ciudadano</a>
                    <a href="{{ route('ciudadanos.buscar') }}" class="btn-action">Buscar Ciudadano</a>
                    <a href="{{ route('ciudadanos.index') }}" class="btn-action btn-edit">Editar Ciudadano</a>
                    <a href="{{ route('ciudadanos.deleteView') }}" class="btn-action">Borrar Ciudadano</a>
                </div>

                {{-- Sección de Trámites --}}
                <div class="menu-section">
                    <h3>Trámites</h3>
                    <a href="{{ route('tramites.create') }}" class="btn-action btn-add">Agregar Trámite</a>
                    <a href="{{ route('tramites.buscar') }}" class="btn-action">Buscar Trámite</a>
                    <a href="{{ route('tramites.index') }}" class="btn-action btn-edit">Editar Trámite</a>
                    <a href="{{ route('tramites.deleteView') }}" class="btn-action">Borrar Trámite</a>
                </div>

                {{-- Sección de Usuarios --}}
                <div class="menu-section">
                    <h3>Usuarios</h3>
                    <a href="{{ route('usuarios.create') }}" class="btn-action btn-add">Agregar Usuario</a>
                    <a href="{{ route('usuarios.buscar') }}" class="btn-action">Buscar Usuario</a>
                    <a href="{{ route('usuarios.index') }}" class="btn-action btn-edit">Editar Usuario</a>
                    <a href="{{ route('usuarios.deleteView') }}" class="btn-action">Borrar Usuario</a>
                </div>

            <div class="button-container">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">Cerrar sesión</button>
                </form>
            </div>
        </fieldset>
    </main>
@endsection