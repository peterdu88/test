<?php namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Redirect;
class SentinelAdminUser {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */

	public function handle($request, Closure $next)
	{
        $user = Sentinel::getUser();
        if(! $user = Sentinel::getUser()){
            Redirect::to('login');
        }

        $admin = Sentinel::findRoleById(\Config::get('fzbconfig.fzbadmin'));

        if(!Sentinel::inRole($admin)){
            return \Redirect::back()->withErrors(['Only admins can access this page.']);
        }

		return $next($request);
	}
}
