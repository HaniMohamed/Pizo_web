<?php

namespace App\Http\Middleware;

use App\Pizo\Events\Models\Event;
use Closure;

class eventOwner
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

        if(!$event_id = $request->route('id'))
            return response()->json(['msg' => "Unacceptable event Id", "error"=>1], 500);

        // check order availability
        if(!$event = Event::find($event_id))
            return response()->json(['msg' => "event not found", "error"=>1], 404);

        // check order owner or admin
        if($event->owner_id != \Auth::id() && \Auth::user()->group != 1)
            return response()->json(['msg' => "You are not the order owner ", "error"=>1], 400);

        return $next($request);
    }
}
