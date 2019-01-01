<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'staff':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('staffdashboard');
              }
              break;

              case 'rgd':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('rgddashboard');
              }
              break;

              case 'bank':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('bankdashboard');
              }
              break;

              case 'landSurveyor':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('landSurveyordashboard');
              }
              break;
    
            default:
              if (Auth::guard($guard)->check()) {
                  return redirect('/dashboard');
              }
              break;
          }
        // if (Auth::guard($guard)->check()) {
        //     return redirect('/dashboard');
        // }

        return $next($request);
    }
}
