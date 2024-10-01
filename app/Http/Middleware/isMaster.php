<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isMaster
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        if (auth()->user()->role == 'admin' || auth()->user()->role == 'kepala_sekolah' || auth()->user()->role == 'kepala_perpus' || auth()->user()->role == 'petugas') {

            return $next($request);
        }

        return redirect('siswa');

    }
}
