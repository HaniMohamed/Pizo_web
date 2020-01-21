<?php

namespace App\Http\Middleware;

use App\Pizo\Messages\Models\Conversations;
use Closure;

class conversationOwner
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
        if(!$conv_id = request()->route('cid'))
            return response()->json(['msg' => "Unacceptable conversation Id", "error"=>1], 500);

        // check order availability
        if(!$conv = Conversations::find($conv_id))
            return response()->json(['msg' => "Job not found", "error"=>1], 404);

        // check job owner or admin
        if($conv->user1 != \Auth::id() && $conv->user2 != \Auth::id())
            return response()->json(['msg' => "Not Allowed ", "error"=>1], 400);

        return $next($request);
    }
}
