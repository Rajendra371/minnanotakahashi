<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Constant;
use Illuminate\Support\Facades\Auth;

class DefineConstant
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
        $constants = Constant::where('isactive', 'Y')->where('locationid', 1)->where('orgid', 1)->get();
        if (!empty($constants)) {
            foreach ($constants as $constant) {
                define($constant->name, $constant->value);
            }
        }
        return $next($request);
    }
}