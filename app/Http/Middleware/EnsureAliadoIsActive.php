<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAliadoIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->role !== 'administrador') {
            $aliado = $user->aliado;

            if (!$aliado || $aliado->estado !== 'activo') {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->withErrors([
                    'email' => 'Tu acceso se encuentra inactivo. Comunícate con el administrador.',
                ]);
            }
        }

        return $next($request);
    }
}