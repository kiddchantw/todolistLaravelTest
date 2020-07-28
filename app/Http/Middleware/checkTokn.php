<?php

namespace App\Http\Middleware;

use Closure;


use App\Users;
use Illuminate\Support\Facades\Auth;

class checkTokn
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
        // return $next($request);
        $user = Users::where('remember_token', '=', $request->remember_token)->first();
        if ($user) {
            $request->merge(['user' => $user]);
            //add this
            $request->setUserResolver(function () use ($user) {
                return $user;
            });
            // if you dump() you can now see the $request has it
            // dump($request->user());
            return $next($request);
        } else {
            return response()->json(['message' => 'User Token not found in checkToken!'], 404);
        }
    }
}
