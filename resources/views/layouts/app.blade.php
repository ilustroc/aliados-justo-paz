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
        <aside class="w-[240px] min-w-[240px] border-r border-slate-200 bg-white">
            <div class="flex h-screen flex-col">

                {{-- Logo --}}
                <div class="border-b border-slate-200 p-6">
                    <img
                        src="{{ asset('img/logo.png') }}"
                        alt="Justo Paz"
                        class="h-12 w-auto object-contain"
                    >
                    <p class="mt-3 text-[13px] font-medium text-slate-400">
                        Panel de Administración
                    </p>
                </div>

                {{-- Menú --}}
                <nav class="flex-1 space-y-1 p-4">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                       {{ request()->routeIs('admin.dashboard') 
                            ? 'bg-[#4F7F45] text-white shadow-sm' 
                            : 'text-slate-600 hover:bg-slate-100' }}">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <rect x="3" y="3" width="7" height="9" rx="1" stroke-width="2"></rect>
                            <rect x="14" y="3" width="7" height="5" rx="1" stroke-width="2"></rect>
                            <rect x="14" y="12" width="7" height="9" rx="1" stroke-width="2"></rect>
                            <rect x="3" y="16" width="7" height="5" rx="1" stroke-width="2"></rect>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.aliados.index') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                       {{ request()->routeIs('admin.aliados.*') 
                            ? 'bg-[#4F7F45] text-white shadow-sm' 
                            : 'text-slate-600 hover:bg-slate-100' }}">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4" stroke-width="2"></circle>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        <span>Aliados</span>
                    </a>

                    <a href="{{ route('admin.conciliaciones.index') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                       {{ request()->routeIs('admin.conciliaciones.*') 
                            ? 'bg-[#4F7F45] text-white shadow-sm' 
                            : 'text-slate-600 hover:bg-slate-100' }}">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2v4a2 2 0 0 0 2 2h4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9H8"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 13H8"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17H8"/>
                        </svg>
                        <span>Conciliaciones</span>
                    </a>
                </nav>

                {{-- Footer sidebar --}}
                <div class="border-t border-slate-200 p-4">
                    <p class="mb-3 truncate text-xs text-slate-400">
                        {{ auth()->user()->email ?? 'garciaparraalejandra@gmail.com' }}
                    </p>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-xs text-slate-500 transition hover:bg-slate-100 hover:text-slate-700"
                        >
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