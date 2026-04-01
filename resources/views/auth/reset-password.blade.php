<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva contraseña | Justo Paz</title>
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
                    <h2 class="auth-title mt-4">Crear nueva contraseña</h2>
                </div>

                @if ($errors->any())
                    <div class="auth-alert mb-5">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="space-y-2">
                        <label class="auth-label">Correo electrónico</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $email) }}"
                            class="auth-input-v3"
                            required
                        >
                    </div>

                    <div class="space-y-2">
                        <label class="auth-label">Nueva contraseña</label>
                        <input
                            type="password"
                            name="password"
                            class="auth-input-v3"
                            placeholder="••••••••"
                            required
                        >
                    </div>

                    <div class="space-y-2">
                        <label class="auth-label">Confirmar contraseña</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="auth-input-v3"
                            placeholder="••••••••"
                            required
                        >
                    </div>

                    <button type="submit" class="btn-auth-v3">
                        Actualizar contraseña
                    </button>
                </form>
            </div>
        </div>

        <div class="auth-visual-panel">
            <div class="visual-grid"></div>

            <div class="relative z-10 px-10 py-12 text-center">
                <img
                    src="{{ asset('svg/login-visual.svg') }}"
                    alt="Nueva contraseña"
                    class="mt-6 w-full max-w-[280px] xl:max-w-[320px] mx-auto"
                >
                <div class="mt-8">
                    <h3 class="text-3xl font-bold tracking-tight text-[#248232]">
                        Acceso Restaurado
                    </h3>
                    <p class="mx-auto mt-3 max-w-[300px] text-sm leading-relaxed text-[#2d3a3a]/80">
                        Define una nueva contraseña segura para continuar.
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>