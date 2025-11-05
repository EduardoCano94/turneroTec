<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Turnos</title>

    {{-- Vincular tu CSS personalizado --}}
    <link rel="stylesheet" href="{{ asset('css/formal.css') }}?v=2">
<body>

    <header>
        <h1>Sistema de Turnos</h1>
        <h2>Inicio de sesión</h2>
    </header>

    <main class="py-4">
        @yield('content')
    </main>

    <footer>
       <p>© Sistema de Turnos y Citas</p>
    </footer>

</body>
</html>
