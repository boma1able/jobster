<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIfAdmin
{
    public function handle(Request $request, Closure $next)
    {

        if (!auth()->user()->isAdmin()){
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
