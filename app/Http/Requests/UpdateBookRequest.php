<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publication_year' => ['required', 'integer', 'min:1800', 'max:' . date('Y')],
            'category' => ['required', 'string', 'max:255', 'in:Fiction,Non-Fiction,Science,History,Technology,Literature'],
        ];
    }

    public function messages(): array
    {
        return [
            'publication_year.min' => 'The publication year must be after 1800.',
            'publication_year.max' => 'The publication year cannot be in the future.',
            'category.in' => 'Please select a valid category from the list.',
        ];
    }
}
