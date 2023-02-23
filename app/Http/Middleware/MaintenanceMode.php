<?php

namespace App\Http\Middleware;

use App\Models\GeneralSetting\SiteSetting;
use Closure;
use Illuminate\Support\Facades\Session;

class MaintenanceMode
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
        $gs = SiteSetting::find(1);
        $maintenance_key = Session::get('maintenance_key');
        if ($gs->site_status == 3 && $maintenance_key != $gs->maintenance_key) {

            return redirect()->route('maintenance');
        }
        return $next($request);
    }
}