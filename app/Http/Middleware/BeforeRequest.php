<?php

namespace App\Http\Middleware;

use App\Components\Common\Utils;
use Closure;
use Illuminate\Support\Facades\Log;

class BeforeRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Utils::requestLog($request->getPathInfo(), $request->getClientIp(), $request->all());

        return $next($request);
    }
}
