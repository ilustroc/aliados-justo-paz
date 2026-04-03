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
<body class="jp-shell">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="jp-sidebar hidden md:flex">
            <div class="flex h-full w-full flex-col">

                <div class="jp-sidebar-top">
                    <div class="jp-brand-wrap">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo Justo Paz" class="jp-brand-logo">
                        <div>
                            <div class="jp-brand-title">Justo Paz</div>
                            <div class="jp-brand-subtitle">
                                {{ auth()->user()->role === 'administrador' ? 'Panel de Administración' : 'Panel de Aliado' }}
                            </div>
                        </div>
                    </div>
                </div>

                <nav class="jp-sidebar-nav">
                    <a href="{{ route('admin.dashboard') }}"
                       class="{{ request()->routeIs('admin.dashboard') ? 'jp-nav-link-active' : 'jp-nav-link' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    @auth
                        @if(auth()->user()->role === 'administrador')
                            <a href="{{ route('admin.aliados.index') }}"
                               class="{{ request()->routeIs('admin.aliados.*') ? 'jp-nav-link-active' : 'jp-nav-link' }}">
                                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span>Aliados</span>
                            </a>
                        @endif
                    @endauth

                    <a href="{{ route('admin.conciliaciones.index') }}"
                       class="{{ request()->routeIs('admin.conciliaciones.*') ? 'jp-nav-link-active' : 'jp-nav-link' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Conciliaciones</span>
                    </a>
                </nav>

                <div class="jp-sidebar-footer">
                    <div class="jp-user-card">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-semibold text-slate-800">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="truncate text-xs text-slate-500">
                                {{ auth()->user()->email }}
                            </p>
                            <p class="mt-2 text-[11px] font-semibold uppercase tracking-[0.16em] text-[#4A7C44]">
                                {{ auth()->user()->role }}
                            </p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="mt-3">
                        @csrf
                        <button type="submit" class="jp-logout-btn">
                            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l5-5-5-5"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12H9"/>
                            </svg>
                            <span>Cerrar sesión</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- CONTENIDO --}}
        <main class="jp-main md:ml-[264px]">
            <div class="jp-container">

                @include('components.alerts')

                @yield('content')
            </div>
        </main>

    </div>

    @stack('scripts')
</body>
</html>