<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class RegistrationService.
 */
class RegistrationService
{
    /**
     * Handle user registration request
     * @param $request
     * @return RedirectResponse
     */
    public function userRegistration($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()) {
            Auth::loginUsingId($user->id);
            return redirect()->intended(route('to-do-list.index'));
        } else {
            return redirect()->route('register')
                ->with('message','Registration not complete. Something went wrong!');
        }
    }

    /**
     * Redirect to change profile form
     * @return Application|Factory|View
     */
    public function changeProfileForm()
    {
        $user = Auth::user();
        return view('auth.change_profile',compact('user'));
    }

    /**
     * Update profile
     * @param $request
     * @return RedirectResponse
     */
    public function updateProfile($request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        if(isset($request->password)) {
            $user->password = Hash::make($request->password);
        }
        if($user->save()) {
            return redirect()->intended(route('to-do-list.index'));
        } else {
            return redirect()->route('register')
                ->with('message','Profile not updated. Something went wrong!');
        }
    }
}
