<?php

namespace App\Http\Middleware;

use Closure;
use Agent;

class RedirectMobile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(Agent::isMobile()) {
            return redirect('http://mobile.localhost:8000/' . $request->path());
        }

        return $next($request);
    }
}
