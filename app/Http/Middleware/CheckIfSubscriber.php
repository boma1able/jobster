<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfSubscriber
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && in_array('Subscriber', auth()->user()->roles->pluck('name')->toArray())){

            return redirect('/');
        }

        return $next($request);
    }

}
