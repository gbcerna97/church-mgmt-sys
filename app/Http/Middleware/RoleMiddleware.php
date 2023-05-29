<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // Check if the user has any of the specified roles
        if ($user && $user->hasAnyRole($roles)) {
            return $next($request);
        }

        // Redirect the user to a specific page if the role check fails
        return redirect('/unauthorized');
    }
}
