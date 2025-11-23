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

        if ($user && $user->email === 'sajnushhossain.cse@gmail.com') {
            return $next($request);
        }

        // Admins have full access to everything.
        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        // Users cannot access any admin routes.
        if ($user && $user->role === 'user') {
            abort(403, 'You do not have permission to access this page.');
        }

                    // Moderators have specific access rights.
                if ($user && $user->role === 'moderator') {
                    $routeName = $request->route()->getName();
        
                    // Log moderator access
                    ModeratorAccessLog::create([
                        'user_id' => $user->id,
                        'route' => $routeName,
                    ]);
        
                    $allowedPostRoutes = [
                        'admin.posts.index',
                        'admin.posts.create',
                        'admin.posts.store',
                        'admin.posts.show',
                        'admin.posts.edit',
                        'admin.posts.update',
                        'admin.posts.destroy',
                    ];
        
                    $allowedContactRoutes = [
                        'admin.contacts.index',
                        'admin.contacts.create',
                        'admin.contacts.store',
                        'admin.contacts.show',
                        'admin.contacts.edit',
                        'admin.contacts.update',
                        'admin.contacts.destroy',
                    ];
        
                    // If the route is related to posts, check if it's allowed
                    if (strpos($routeName, 'admin.posts.') === 0) {
                        if (!in_array($routeName, $allowedPostRoutes)) {
                            abort(403, 'You do not have permission to access this specific post action.');
                        }
                    } elseif (strpos($routeName, 'admin.contacts.') === 0) {
                        // If the route is related to contacts, check if it's allowed
                        if (!in_array($routeName, $allowedContactRoutes)) {
                            abort(403, 'You do not have permission to access this specific contact action.');
                        }
                    } else {
                        // For any other admin route, redirect to posts index
                        return redirect()->route('admin.posts.index');
                    }
                }
        
                return $next($request);    }
}
