<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;


class CheckPendingInvitations
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $pendingInvitation = Invitation::where('email', Auth::user()->email)
                                           ->where('status', 'pending')
                                           ->first();
            if ($pendingInvitation) {
                session(['pending_invitation' => $pendingInvitation]);
            }
        }

        return $next($request);
    }
}