<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
		// Pastikan user sudah login
		if (!$request->user()) {
			return redirect()->route('login');
		}

		// Cek apakah role user sesuai
		if ($request->user()->role !== $role) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
