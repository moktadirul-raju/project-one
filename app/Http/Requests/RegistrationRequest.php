<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ];
    }

    /**
     * Get the validation rules message to the request
     * @returns array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The Name field is required.',
            'email.required' => 'The Email field is required.',
            'email.email' => 'The Email should be valid email address',
            'password.required' => 'The Password field is required.',
            'password.min' => 'The Password should be minimum 6 character',
            'confirm_password.required' => 'The Confirm Password field is required.',
            'confirm_password.same' => 'The Confirm Password should be same as Password',
        ];
    }
}
