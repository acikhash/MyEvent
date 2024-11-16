<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Log the authenticated user and their role
        if (Auth::check()) {
            \Log::info('Authenticated User: ', ['id' => Auth::id(), 'role' => Auth::user()->role]);
        } else {
            \Log::warning('No authenticated user.');
        }

        // Check if user has the required role
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            \Log::error('Unauthorized access attempt.', [
                'user_id' => Auth::id(),
                'role' => Auth::user()->role ?? null,
                'required_roles' => $roles
            ]);
            abort(403, 'This action is unauthorized.');
        }
        return $next($request);
    }
}
