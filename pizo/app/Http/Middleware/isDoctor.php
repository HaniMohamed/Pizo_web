<?php

namespace App\Http\Middleware;

use Closure;


class isDoctor
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
        $group = \Auth::user()->group;
        if($group != 3)
            return response()->json(['msg' => "Only Doctors can create orders", "error"=>1], 500);

        return $next($request);
    }
}
