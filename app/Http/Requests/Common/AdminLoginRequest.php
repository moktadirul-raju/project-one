<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
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
            'mobile_email' => 'required',
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
            'mobile_email.required' => 'The Mobile Or Email field is required.',
            'password.required' => 'The Password field is required.'
        ];
    }
}
