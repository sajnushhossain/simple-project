<?php

namespace App\Http\Middleware;

use App\Models\ModeratorAccessLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->role === 'moderator') {
            $routeName = $request->route()->getName();

            // Log moderator access
            ModeratorAccessLog::create([
                'user_id' => $user->id,
                'route' => $routeName,
            ]);

            if (strpos($routeName, 'admin.posts.') !== 0 && $routeName !== 'admin.posts.index') {
                return redirect()->route('admin.posts.index');
            }
        }

        return $next($request);
    }
}
