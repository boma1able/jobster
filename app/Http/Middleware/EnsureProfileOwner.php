<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        $userId = $request->route('user')->id ?? null;

        if ($userId && (auth()->id() !== (int) $userId && !auth()->user()?->isAdmin())) {
        abort(403, 'You can edit only your profile!');
    }

        return $next($request);
    }
}
