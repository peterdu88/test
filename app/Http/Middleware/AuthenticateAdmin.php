<?php namespace App\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;

class AuthenticateAdmin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */

    public function handle($request, Closure $next) {

        if (!Sentinel::check() && !Sentinel::hasAccess('admin'))
        {
            return Redirect::to('login')->withErrors(['Only admins can access this page.']);
        }

        return $next($request);
    }


}
