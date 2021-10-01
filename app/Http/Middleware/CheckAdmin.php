<?php
namespace App\Http\Middleware;
use Closure;
class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->is_admin) {
            return $next($request);
        }
        return redirect()->route('login');
    }
}
