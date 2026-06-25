<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOwnerIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->role === 'pemilik') {
            if ($user->status_verifikasi === 'menunggu') {
                return redirect()->route('verification.owner.waiting');
            } elseif ($user->status_verifikasi === 'ditolak') {
                return redirect()->route('verification.owner.rejected');
            }
        }

        return $next($request);
    }
}
