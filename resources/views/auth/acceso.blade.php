<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso | Justo Paz</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-[#F5F5F3]">
    <div class="mx-auto flex min-h-screen max-w-6xl items-center justify-center px-6">
        <div class="grid w-full max-w-5xl gap-8 rounded-3xl bg-white p-8 shadow-xl lg:grid-cols-2">
            <div class="hidden rounded-3xl bg-[#3F7F46] p-8 text-white lg:block">
                <div class="text-3xl font-extrabold">Justo Paz</div>
                <p class="mt-4 text-white/90">
                    Ingresa a tu panel privado de aliados con un enlace seguro enviado a tu correo.
                </p>
            </div>

            <div class="flex items-center">
                <div class="w-full">
                    <h1 class="text-4xl font-extrabold text-[#2B2B2B]">Acceso de aliados</h1>
                    <p class="mt-2 text-slate-500">Te enviaremos un magic link a tu correo.</p>

                    <form class="mt-8 space-y-4">
                        <div>
                            <label class="mb-2 block text-sm font-semibold">Correo electrónico</label>
                            <input type="email" class="jp-input" placeholder="correo@empresa.com">
                        </div>

                        <button type="button" class="jp-btn-primary w-full">
                            Enviar enlace de acceso
                        </button>
                    </form>

                    <p class="mt-4 text-xs text-slate-500">
                        Solo aliados activos pueden ingresar.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>