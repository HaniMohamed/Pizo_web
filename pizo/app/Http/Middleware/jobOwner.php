<?php

namespace App\Http\Middleware;

use App\Pizo\Jobs\Models\Jobs;
use Closure;

class jobOwner
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
        if(!$job_id = request()->route('id'))
            return response()->json(['msg' => "Unacceptable Job Id", "error"=>1], 500);

        // check order availability
        if(!$job = Jobs::find($job_id))
            return response()->json(['msg' => "Job not found", "error"=>1], 404);

        // check job owner or admin
        if($job->owner_id != \Auth::id() && \Auth::user()->group != 1)
            return response()->json(['msg' => "You are not the order owner ", "error"=>1], 400);

        return $next($request);
    }
}
