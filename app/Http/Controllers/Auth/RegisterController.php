<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\RegistrationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    /**
     * @var RegistrationService
     */
    private $registrationService;

    /**
     * Define constructor function
     */
    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    /**
     * Handle user registration request
     * @param RegistrationRequest $request
     * @return RedirectResponse
     */
    public function userRegister(RegistrationRequest $request)
    {
        return $this->registrationService->userRegistration($request);
    }

    /**
     * Redirect to change profile form
     * @return Application|Factory|View
     */
    public function changeProfileForm()
    {
        return $this->registrationService->changeProfileForm();
    }

    /**
     * Profile update request handle
     * @param UpdateProfileRequest $request
     * @return RedirectResponse
     */
    public function updateProfile(UpdateProfileRequest $request): RedirectResponse
    {
        return $this->registrationService->updateProfile($request);
    }
}
