<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PenyewaVerified
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $status = optional($user->penyewa)->status;

        if ($user?->role !== 'penyewa' || $status !== 'Terverifikasi') {
            return redirect()->route('penyewa.status')
                ->with('info', 'Akun kamu belum diverifikasi admin. Silakan tunggu.');
        }

        return $next($request);
    }
}
