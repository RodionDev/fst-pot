<?php
namespace App\Http\Middleware;
use Closure;
class CheckApproved
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->approved_at) {
            return $next($request);
        }
        return redirect()->route('approval');
    }
}
