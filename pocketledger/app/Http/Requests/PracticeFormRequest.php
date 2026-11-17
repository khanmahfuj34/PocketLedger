<?php

namespace App\Http\Requests;

// use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PracticeFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
     public function rules(): array
    {
        return [
            'name' => 'required|string|alpha|min:3|max:50',
            'email' => 'required|email',
            'city' => 'required|string|alpha',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your name.',
            'name.alpha' => 'Name must contain only letters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email.',
            'city.required' => 'City is required.',
        ];
    }
}
