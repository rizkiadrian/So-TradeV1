<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFinancialRequest extends FormRequest
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
            'income_level' => 'nullable|numeric|between:0,999999999999999.99', // Validate income level
            'household_size' => 'nullable|integer|min:1', // Validate household size
            'monthly_expenses' => 'nullable|numeric|between:0,999999999999999.99', // Validate monthly expenses
            'savings_amount' => 'nullable|numeric|between:0,999999999999999.99', // Validate savings amount
        ];
    }
}
