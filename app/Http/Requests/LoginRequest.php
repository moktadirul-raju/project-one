<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'email' => 'required',
            'password' => 'required'
        ];
    }

    /**
     * Get the validation rules message to the request
     * @returns array
     */
    public function messages(): array
    {
        return [
            'email.required' => 'The Email field is required.',
            'password.required' => 'The Password field is required.'
        ];
    }
}
