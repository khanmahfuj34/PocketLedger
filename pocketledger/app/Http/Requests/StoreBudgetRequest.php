<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBudgetRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $month = $this->input('budget_month');

        if (is_string($month) && preg_match('/^\d{4}-\d{2}$/', $month)) {
            $this->merge(['budget_month' => $month . '-01']);
        }
    }

    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'category_id' => [
                'required',
                'integer',
                Rule::exists('categories', 'id')
                    ->where('user_id', $this->user()?->id)
                    ->where('type', 'expense')
                    ->where('is_active', true),
            ],
            'amount' => ['required', 'numeric', 'gt:0', 'max:9999999999999.99'],
            'budget_month' => [
                'required',
                'date_format:Y-m-d',
                Rule::unique('budgets', 'budget_month')
                    ->where('user_id', $this->user()?->id)
                    ->where('category_id', $this->input('category_id')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.exists' => 'Please select one of your active expense categories.',
            'budget_month.date_format' => 'Please select a valid budget month.',
            'budget_month.unique' => 'A budget already exists for this category and month.',
        ];
    }
}

