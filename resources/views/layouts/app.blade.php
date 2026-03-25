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
<body class="bg-[#F5F5F3] antialiased scrollbar-gutter-stable"> 
<div class="jp-shell flex min-h-screen">
    <aside class="jp-sidebar hidden md:block w-[240px] min-w-[240px] h-screen sticky top-0 bg-white border-r border-slate-100 flex-shrink-0">
        <div class="flex h-full flex-col">
            <div class="p-6">
                <div class="mb-6">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Justo Paz" class="h-12 w-auto object-contain">
                </div>
                <div class="text-[13px] font-medium text-slate-400">
                    Panel de Administración
                </div>
            </div>

            <nav class="flex-1 space-y-1 px-3">
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

            <div class="p-6">
                <div class="text-[10px] font-bold tracking-widest text-slate-300 uppercase">
                    aliados.justopaz.com
                </div>
            </div>
        </div>
    </aside>

    <main class="jp-main flex-1 flex flex-col min-w-0">
        <div class="w-full max-w-[1200px] px-10 py-10">
            @if(session('ok'))
                <div class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-100 bg-emerald-50 px-5 py-4 text-sm text-emerald-700 shadow-sm">
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