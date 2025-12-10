<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // "Name should be a string of any size greater than 5"
            'name' => ['required', 'string', 'min:6'],

            // "Email should be a valid email address and unique"
            'email' => ['required', 'email', 'unique:people,email'],
        ];
    }

    /**
     * Set messages for error validation
     */
    public function messages(): array
    {
        return [
            'name.min' => 'Name should have min 6 characters.',
            'email.unique' => 'This email exists.',
        ];
    }
}
