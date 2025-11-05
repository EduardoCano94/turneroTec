<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Turnos - Iniciar sesión</title>
    <link rel="stylesheet" href="{{ asset('css/formal.css') }}">
</head>
<body>
    <main>
        <header>
            <h1>Sistema de Turnos</h1>
            <h2>Inicio de sesión</h2>
        </header>

        @if (session('status'))
            <div id="alerta">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div id="alerta">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <fieldset>
                <legend>Datos de acceso</legend>

                <label for="email">Correo electrónico:</label>
                <input type="email" name="email" id="email" placeholder="usuario@dominio.com" required autofocus>

                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" placeholder="********" required>

                <input type="submit" value="Iniciar sesión">
            </fieldset>
        </form>

        <footer>
            <blockquote>"La contraseña más segura es aquella que nunca se comparte."</blockquote>
            <p>© Sistema de Turnos y Citas</p>
        </footer>
    </main>
</body>
</html>
