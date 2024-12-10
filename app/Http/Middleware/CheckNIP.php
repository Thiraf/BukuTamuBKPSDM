<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckNIP
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
        if (!$request->session()->has('nip')) {
            return redirect()->route('index')->withErrors('Silakan masukkan NIK terlebih dahulu.');
        }

        return $next($request);
    }
}
