<?php

namespace App\Admin\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $redirectTo = route('admin.login');
        if (Auth::guard('admin')->guest() && !$this->shouldPassThrough($request)) {
            return redirect()->guest($redirectTo);
        }

        return $next($request);
    }

    /**
     * Determine if the request has a URI that should pass through verification.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function shouldPassThrough($request)
    {

        $routeName = $request->path();
        $excepts = [
            config('app.admin_prefix') . '/auth/login',
            config('app.admin_prefix') . '/auth/logout',
        ];
        return in_array($routeName, $excepts);

    }
}
