<?php

namespace App\Http\Middleware;

use App\Models\Customer; // Import the missing class
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerM
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , $id): Response
    {
        if (!(Customer::find($id) != null &&Customer::find($id)->user_id === auth()->user()->id)) {
            return redirect()->route('customers.index');
        }
        return $next($request);
    }
}
