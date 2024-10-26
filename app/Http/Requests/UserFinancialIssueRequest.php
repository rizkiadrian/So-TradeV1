<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\UserIssue;

class UserFinancialIssueRequest extends FormRequest
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
            'current_financial_issues' => 'required|array', // Ensure it's an array structure
            
            'current_financial_issues.biggest_problem' => 'required|string',
            
            'current_financial_issues.types_of_debt' => 'required|array',
            'current_financial_issues.types_of_debt.*' => 'in:' . implode(',', UserIssue::TYPE_OF_DEBTS),
            
            'current_financial_issues.how_to_solve_expectation' => 'nullable|string',
            'current_financial_issues.most_help_required' => 'nullable|string',
        ];
    }
}
