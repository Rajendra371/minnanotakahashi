<?php

namespace App\Http\Middleware;

use App\Helpers\General;
use Closure;

class InsertIpLog
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
        $log = new General;
        $log->insert_new_visit();
        return $next($request);
    }
}