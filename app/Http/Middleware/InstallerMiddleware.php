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
     * @param \Illuminate\Http\Request $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (AppSettings::where('key', 'installed')->first()->value === '1') {
            return $next($request);
        }
        if (str_starts_with($request->requestUri, '/installer')) {
            return $next($request);
        }

        return redirect('/installer');
    }
}
