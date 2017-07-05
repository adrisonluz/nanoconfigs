<?php namespace NanoSoluctions\NanoConfigs;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class NanoMiddleware {
    protected $app;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('nano')->check()) {
            return redirect('/login');
        }

        return $next($request);
    }
}
