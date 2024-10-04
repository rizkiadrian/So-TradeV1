<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:15', // Adjust max length as needed
            'date_of_birth' => 'nullable|date|date_format:Y-m-d|before:today', // Ensure it's a valid date and before today
            'address' => 'required|string|max:255',
        ];
    }

    /**
     * Custom validation messages for request inputs.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'phone_number.max' => 'Phone number must not exceed 15 characters.',
            'date_of_birth.before' => 'Date of birth must be a date before today.',
            'address.required' => 'Address is required.',
        ];
    }
}
