<?php

namespace App\Http\Middleware;

use Closure;

class MustBeAdmin
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
        $user = $request->user();
        if($user && $user->status=='2'){
            return $next($request);
        }

        abort(403,'คุณไม่มีสิทธิ์การเข้าถึงหน้านี้');
    }
}
