<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Mengambil user yang sedang login
        $user = Auth::guard('admin')->user();

        // Mengecek apakah user memiliki role super admin (misalnya role ID 1 adalah super admin)
        if ($user->id_role != 1) {
            // Jika bukan super admin, redirect ke halaman lain atau tampilkan error
            return redirect()->route('dashboard')->with('error', 'Akses ditolak, hanya untuk Super Admin.');
        }

        return $next($request);
    }
}
