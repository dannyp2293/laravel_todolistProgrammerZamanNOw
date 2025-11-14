<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Facades\Redirect; // jika ingin pakai facade

class OnlyMemberMiddleware
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (! $request->session()->has('user')) {
            return redirect()->to('/'); // atau: return Redirect::to('/');
        }

        return $next($request);
    }
}
