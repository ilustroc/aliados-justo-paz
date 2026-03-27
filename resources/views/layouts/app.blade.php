<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aliados Justo Paz')</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logotipo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logotipo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F6F6F3] text-slate-900 antialiased">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="hidden md:block sticky top-0 h-screen w-[240px] min-w-[240px] border-r border-slate-200 bg-white flex-shrink-0">
            <div class="flex h-full flex-col">
                <div class="p-6 border-b border-slate-200">
                    <div class="mb-6">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo Justo Paz" class="h-12 w-auto object-contain">
                    </div>
                    <div class="text-[13px] font-medium text-slate-400">
                        Panel de Administración
                    </div>
                </div>

                <nav class="flex-1 space-y-1 px-3 py-4">
                    <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'jp-nav-link-active' : 'jp-nav-link' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.aliados.index') }}"
                    class="{{ request()->routeIs('admin.aliados.*') ? 'jp-nav-link-active' : 'jp-nav-link' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span>Aliados</span>
                    </a>

                    <a href="{{ route('admin.conciliaciones.index') }}"
                    class="{{ request()->routeIs('admin.conciliaciones.*') ? 'jp-nav-link-active' : 'jp-nav-link' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Conciliaciones</span>
                    </a>
                </nav>

                <div class="mt-auto border-t border-slate-200 p-4">
                    <p class="mb-3 truncate text-xs text-slate-400">
                        admin@justopaz.com
                    </p>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-xs text-slate-500 transition hover:bg-slate-100 hover:text-slate-700">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l5-5-5-5"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12H9"/>
                            </svg>
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- CONTENIDO --}}
        <main class="min-w-0 flex-1 bg-[#F6F6F3]">
            <div class="px-10 py-8">

                @if(session('ok'))
                    <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ session('ok') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

    </div>

    @stack('scripts')
</body>
</html>