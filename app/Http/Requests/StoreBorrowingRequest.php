<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBorrowingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'borrowed_at' => ['required', 'date', 'before_or_equal:today'],
            'due_date' => ['required', 'date', 'after:borrowed_at', 'after_or_equal:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'due_date.after' => 'Return date must be after borrowing date',
            'due_date.after_or_equal' => 'Return date cannot be in the past',
            'borrowed_at.before_or_equal' => 'Borrow date cannot be in the future',
        ];
    }
}
