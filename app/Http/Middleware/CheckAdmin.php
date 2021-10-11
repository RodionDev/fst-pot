<?php
namespace App\Http\Middleware;
use Closure;
class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->hasAnyRoles(['admin','superadmin'])) {
            return $next($request);
        }
        return redirect()->route('login');
    }
}
