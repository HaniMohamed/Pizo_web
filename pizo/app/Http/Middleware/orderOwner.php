<?php

namespace App\Http\Middleware;

use App\Pizo\Orders\Models\Orders;
use Closure;
use Illuminate\Support\Facades\Input;

class orderOwner
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
        // check order is
        if(!$order_id = request()->route('id'))
            return response()->json(['msg' => "Unacceptable Order Id", "error"=>1], 500);

        // check order availability
        if(!$order = Orders::find($order_id))
            return response()->json(['msg' => "Order not found", "error"=>1], 404);

        // check order owner or admin
        if($order->doctor_id != \Auth::id() && \Auth::user()->group != 1)
            return response()->json(['msg' => "You are not the order owner ", "error"=>1], 400);

        return $next($request);
    }
}
