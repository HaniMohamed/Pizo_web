<?php

namespace App\Http\Middleware;

use App\Pizo\Products\Models\Products;
use Closure;

class productOwner
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
        if(!$product_id = request()->route('id'))
            return response()->json(['msg' => "Unacceptable Product Id", "error"=>1], 500);
        // check order availability
        if(!$product = Products::find($product_id))
            return response()->json(['msg' => "Product not found", "error"=>1], 404);

        // check order owner or admin

        if($product->owner_id != \Auth::id() && \Auth::user()->group != 1)
            return response()->json(['msg' => "You are not the Product owner ", "error"=>1], 400);

        return $next($request);
    }
}
