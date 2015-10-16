<?php namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Redirect;
class SentinelStdUser {

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
        $roles = Sentinel::findRoleByName('member');

        if(!$user->inRole($roles)){
            Redirect::to('login')->withErrors('your are not member of this system, Please login first.');
        }
		return $next($request);
	}

}
