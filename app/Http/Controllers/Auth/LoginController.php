<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;

class LoginController extends Controller
{
    /**
     * @var LoginService
     */
    private $loginService;

    /**
     * Define constructor function
     */
    public function __construct(LoginService $loginService) {
        $this->loginService = $loginService;
    }

    /**
     * Handle user login request
     * @param LoginRequest $request
     * @return mixed
     */
    public function userLogin(LoginRequest $request) {
        return $this->loginService->userLogin($request);
    }

    /**
     * Handle logout request
     * @return mixed
     */
    public function logout() {
        return $this->loginService->logout();
    }
}
