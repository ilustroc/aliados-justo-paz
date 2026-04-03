@if(session('ok') || session('error') || session('warning') || session('info'))
    @php
        $type = session('ok') ? 'success' : (session('error') ? 'error' : (session('warning') ? 'warning' : 'info'));
        $message = session('ok') ?? session('error') ?? session('warning') ?? session('info');

        $styles = [
            'success' => [
                'wrap' => 'border-emerald-200 bg-emerald-50 text-emerald-900',
                'bar'  => 'bg-emerald-500',
            ],
            'error' => [
                'wrap' => 'border-red-200 bg-red-50 text-red-900',
                'bar'  => 'bg-red-500',
            ],
            'warning' => [
                'wrap' => 'border-amber-200 bg-amber-50 text-amber-900',
                'bar'  => 'bg-amber-500',
            ],
            'info' => [
                'wrap' => 'border-sky-200 bg-sky-50 text-sky-900',
                'bar'  => 'bg-sky-500',
            ],
        ];
    @endphp

    <div
        id="global-alert"
        class="fixed right-5 top-5 z-[9999] w-[92vw] max-w-sm overflow-hidden rounded-2xl border shadow-[0_20px_45px_rgba(15,23,42,0.16)] backdrop-blur transition-all duration-300 ease-out {{ $styles[$type]['wrap'] }}"
    >
        <div class="flex items-start gap-3 p-4">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-white shadow-sm">
                <img src="{{ asset('img/logo.png') }}" alt="Justo Paz" class="h-7 w-auto object-contain">
            </div>

            <div class="min-w-0 flex-1">
                <p class="text-sm font-bold leading-none">Justo Paz</p>
                <p class="mt-1.5 text-sm leading-relaxed">
                    {{ $message }}
                </p>
            </div>

            <button
                type="button"
                id="close-alert"
                class="shrink-0 rounded-xl p-1.5 text-slate-400 transition hover:bg-white/70 hover:text-slate-600"
                aria-label="Cerrar alerta"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="h-1 w-full bg-black/5">
            <div id="alert-progress" class="h-1 {{ $styles[$type]['bar'] }}"></div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alertBox = document.getElementById('global-alert');
            const closeBtn = document.getElementById('close-alert');
            const progress = document.getElementById('alert-progress');

            if (!alertBox) return;

            if (progress) {
                progress.style.width = '100%';
                progress.style.transition = 'width 5s linear';
                requestAnimationFrame(() => {
                    progress.style.width = '0%';
                });
            }

            const hideAlert = () => {
                alertBox.classList.add('opacity-0', 'translate-y-[-8px]', 'scale-[0.98]');
                setTimeout(() => {
                    alertBox.remove();
                }, 300);
            };

            const autoHide = setTimeout(hideAlert, 5000);

            if (closeBtn) {
                closeBtn.addEventListener('click', function () {
                    clearTimeout(autoHide);
                    hideAlert();
                });
            }
        });
    </script>
    @endpush
@endif