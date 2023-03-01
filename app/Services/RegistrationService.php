<?php

namespace App\Services;

use App\Models\User;
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userRegistration($request): \Illuminate\Http\RedirectResponse
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function changeProfileForm() {
        $user = Auth::user();
        return view('auth.change_profile',compact('user'));
    }

    public function updateProfile($request) {
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
