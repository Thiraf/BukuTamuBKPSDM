<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckNIK
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
        // Cek apakah session memiliki data NIK
        if (!$request->session()->has('nik')) {
            // Jika NIK belum ada di session, redirect ke halaman awal dengan pesan error
            return redirect()->route('index')->withErrors('Silakan masukkan NIK terlebih dahulu.');
        }

        // Jika NIK ada di session, lanjutkan request
        return $next($request);
    }
}
