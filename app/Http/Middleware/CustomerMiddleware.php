<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // BELUM LOGIN
        if (!auth()->check()) {

            return redirect()->route('customer.login');

        }

        // BUKAN CUSTOMER
        if (auth()->user()->role !== 'customer') {

            abort(403);

        }

        return $next($request);
    }
}