<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Member; 

class CheckUserData
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        // dd($user);
        if ($user) {
            // dd($member);
            if ($user->is_profile_updated == 0 || $user->approved == 0) {
                // Flash a message to the session
                $request->session()->flash('incomplete_data', true);
    
                // Flash a specific message
                $message = ($user->approved == 0)
                    ? 'Update_profile_message'
                    : 'Wait_approval_message';
    
                $request->session()->flash('message', $message);
                return redirect()->route('profile_settings')->with('message', $message);
            }
        }
        return $next($request);
    }
}