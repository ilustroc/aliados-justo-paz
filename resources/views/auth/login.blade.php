<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso | Justo Paz</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logotipo.png') }}">
    @vite(['resources/css/auth.css'])
</head>
<body class="auth-container">
    <div class="auth-card">
        <div class="auth-banner">
            <div>
                <img src="{{ asset('img/logo.png') }}" alt="Justo Paz" class="h-16 brightness-0 invert mb-8">
                <h2 class="text-3xl font-bold leading-tight">Programa de<br>Aliados 2026</h2>
                <p class="mt-4 text-white/80 text-lg">
                    Gestiona tus conciliaciones, consulta tus tarifas preferenciales y alcanza el tramo Premium. [cite: 7, 15]
                </p>
            </div>
            
            <div class="text-sm text-white/60 uppercase tracking-widest font-semibold">
                aliados.justopaz.com
            </div>
        </div>

        <div class="auth-form-section">
            <div class="w-full max-w-sm mx-auto">
                <div class="mb-10">
                    <h1 class="text-3xl font-bold text-[#2B2B2B]">Admin Access</h1>
                    <p class="mt-2 text-slate-500">Panel de Administración Justo Paz</p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-400">Correo institucional</label>
                        <input type="email" name="email" class="jp-input-auth" placeholder="admin@justopaz.com" required autofocus>
                        @error('email') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-400">Contraseña</label>
                        <input type="password" name="password" class="jp-input-auth" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="jp-btn-primary w-full py-4 text-base shadow-lg shadow-[#4A7c44]/20">
                        Iniciar Sesión
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <a href="{{ route('acceso') }}" class="text-sm font-semibold text-[#4A7c44] hover:underline">
                        ¿Eres un Aliado? Ingresa aquí con tu correo
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>