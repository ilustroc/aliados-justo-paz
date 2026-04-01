<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña | Justo Paz</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logotipo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/auth.css'])
</head>
<body class="auth-page-wrapper">

    <div class="auth-split-card">
        <div class="auth-form-panel">
            <div class="w-full max-w-sm">
                <div class="mb-8">
                    <img src="{{ asset('img/logo.png') }}" alt="Justo Paz" class="h-14 w-auto">
                </div>

                <div class="mb-4">
                    <h2 class="auth-title mt-4">¿Olvidaste tu contraseña?</h2>
                    <p class="mt-2 text-sm text-[#2d3a3a]/70">
                        Ingresa tu correo y te enviaremos un enlace para restablecerla.
                    </p>
                </div>

                @if (session('status'))
                    <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="auth-alert mb-5">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="space-y-2">
                        <label class="auth-label">Correo electrónico</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="auth-input-v3"
                            placeholder="admin@justopaz.com"
                            required
                            autofocus
                        >
                    </div>

                    <button type="submit" class="btn-auth-v3">
                        Enviar enlace de recuperación
                    </button>

                    <div class="text-center pt-1">
                        <a href="{{ route('login') }}" class="auth-link">
                            Volver al acceso
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="auth-visual-panel">
            <div class="visual-grid"></div>

            <div class="relative z-10 px-10 py-12 text-center">
                <img
                    src="{{ asset('svg/login-visual.svg') }}"
                    alt="Recuperar acceso"
                    class="mt-6 w-full max-w-[280px] xl:max-w-[320px] mx-auto"
                >
                <div class="mt-8">
                    <h3 class="text-3xl font-bold tracking-tight text-[#248232]">
                        Recuperación Segura
                    </h3>
                    <p class="mx-auto mt-3 max-w-[300px] text-sm leading-relaxed text-[#2d3a3a]/80">
                        Restablece tu acceso de forma rápida y segura mediante tu correo autorizado.
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>