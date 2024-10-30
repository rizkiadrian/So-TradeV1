<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
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
            'full_name'   => 'required|string|max:255',
            'email'       => [
                'required',
                'email',
                'max:255',
            ],
            'phone_number' => 'nullable|string|max:15',
            'subject'     => 'required|string|max:255',
            'message'     => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'We are already received your email, please expecting a reply from us in 1 - 2 days',
        ];
    }

    
}
