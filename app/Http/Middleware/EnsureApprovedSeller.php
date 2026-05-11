<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureApprovedSeller
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user || $user->seller_status !== 'approved' || $user->is_admin) {
            abort(403, 'Anda bukan penjual yang terverifikasi');
        }

        return $next($request);
    }
}
