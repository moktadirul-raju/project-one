<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

/**
 * Class AuthService.
 */
class AuthService
{
    /**
     * Attempt to admin login
     */
    public function adminLogin($request) {
        if(is_numeric($request->get('email_or_mobile'))){
            $credentials = [
                'mobile'=>$request->get('mobile_email'),
                'password'=>$request->get('password')
            ];
        } elseif (filter_var($request->get('mobile_email'), FILTER_VALIDATE_EMAIL)) {
            $credentials = [
                'email' => $request->get('mobile_email'),
                'password'=>$request->get('password'),
            ];
        }
        $credentials['active_status'] = 1;

        if (Auth::guard('admin')->attempt($credentials,$request->remember)) {
            if (!empty(session()->get('session_redirect_url'))) {
                return Redirect::to(session('session_redirect_url'));
            } else{
                return redirect()->intended(route('admin.dashboard'));
            }
        }
    }
}
