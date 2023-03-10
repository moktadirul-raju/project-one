<?php

namespace App\Services;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * Class LoginService.
 */
class LoginService
{
    /**
     * Handle user login request
     * @param $request
     * @return RedirectResponse
     */
    public function userLogin($request): RedirectResponse
    {
        $credentials = [
            'email' => $request->get('email'),
            'password'=>$request->get('password'),
        ];

        if (Auth::guard()->attempt($credentials,$request->remember)) {
            return redirect()->intended(route('to-do-list.index'));
        }
        return redirect()->back()
            ->with('message', 'Your entered Email/Password is incorrect')
            ->withInput($request->only('email', 'remember'));
    }

    /**
     * User logout from device
     * @return RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('home');
    }
}
