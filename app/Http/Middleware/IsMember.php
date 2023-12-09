<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Cache;
use Carbon\Carbon;

class IsMember
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
        // $user = auth()->user();
        // //$user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        // if ($request->is('api/*') && $user->blocked == 1) {
        //     return response()->json([
        //         'result' => false,
        //         'status' => 'blocked',
        //         'message' => translate('user is banned')
        //     ]);
        // }

        if (Auth::check() && Auth::user()->user_type == 'member') {
            // Set a short cache expiration time to indicate the user is online
            $expiresAt = Carbon::now()->addMinutes(3);
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
        
            // Check if the user is blocked
            if (Auth::user()->blocked == 1) {
                // User is blocked, redirect to a blocked page
                return redirect()->route('user.blocked');
            } else {
                // User is not blocked, allow the request to proceed
                return $next($request);
            }
        } else {
            // User is not authenticated or is not a 'member'
        
            // Store the current URL in the session for later redirection after login
            session(['link' => url()->current()]);
        
            // Redirect to the login page
            return redirect()->route('user.login');
        }
    }
}
