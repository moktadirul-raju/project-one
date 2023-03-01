<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\RegistrationService;

class RegisterController extends Controller
{
    /**
     * @var RegistrationService
     */
    private $registrationService;

    /**
     * Define constructor function
     */
    public function __construct(RegistrationService $registrationService) {
        $this->registrationService = $registrationService;
    }

    /**
     * Handle user registration request
     * @param RegistrationRequest $request
     * @return mixed
     */
    public function userRegister(RegistrationRequest $request) {
        return $this->registrationService->userRegistration($request);
    }

    /**
     * Redirect to change profile form
     * @return mixed
     */
    public function changeProfileForm() {
        return $this->registrationService->changeProfileForm();
    }

    public function updateProfile(UpdateProfileRequest $request) {
        return $this->registrationService->updateProfile($request);
    }
}
