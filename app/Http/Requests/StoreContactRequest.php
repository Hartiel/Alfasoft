<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactRequest extends FormRequest
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
            'person_id' => ['required', 'exists:people,id'],
            'country_code' => ['required', 'string'],
            'number' => [
                'required',
                'digits:9',
                // Cancel duplicated
                Rule::unique('contacts')->where(function ($query) {
                    return $query->where('country_code', $this->country_code)
                                 ->where('number', $this->number);
                }),
            ],
        ];
    }

    /**
     * Set messages for error validation
     */
    public function messages(): array
    {
        return [
            'number.digits' => 'The number must be exactly 9 digits.',
            'number.unique' => 'This number exist for this country code.',
        ];
    }
}
