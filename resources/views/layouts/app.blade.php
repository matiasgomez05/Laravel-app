<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav>
        <!-- Aquí puedes agregar tu barra de navegación -->
        <a href="/">Inicio</a> |
        <a href="/provincias">Provincias</a>
    </nav>

    <!-- Mensajes flash -->
    @if (session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; margin: 10px 0; border-radius: 4px;">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div style="background: #f8d7da; color: #721c24; padding: 10px; margin: 10px 0; border-radius: 4px;">
            {{ session('error') }}
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer style="margin-top: 40px; text-align: center; color: #888;">
        <hr>
        <small>&copy; {{ date('Y') }} Mi Aplicación. Todos los derechos reservados.</small>
    </footer>
    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 