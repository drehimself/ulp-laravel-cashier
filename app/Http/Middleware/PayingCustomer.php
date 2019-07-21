<?php

namespace App\Http\Middleware;

use Closure;

class PayingCustomer
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
        if ($request->user() && ! $this->isPayingCustomer($request)) {
            // This user is not a paying customer...
            return redirect('home');
        }

        return $next($request);
    }

    private function isPayingCustomer($request)
    {
        return $request->user()->subscribed('monthly') || $request->user()->subscribed('yearly');
    }
}
