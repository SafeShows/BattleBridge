<?php

namespace App\Http\Middleware;

use App\Models\AppSettings;
use Closure;
use Illuminate\Http\Request;

class InstallerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // dd($request->requestUri->);
        $appSettings = [];
        $_appSettings =  AppSettings::all();

        foreach($_appSettings as $setting) {
            $appSettings[$setting->key] = $setting->value;
        }
        if ($appSettings['installed'] == '1') {
            return $next($request);
        }
        if (str_starts_with($request->requestUri, "/installer")) {
            return $next($request);
        }

        return redirect('/installer');
    }
}
