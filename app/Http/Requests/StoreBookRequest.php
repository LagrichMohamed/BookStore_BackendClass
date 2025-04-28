<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publication_year' => ['required', 'integer', 'min:1000', 'max:' . (date('Y') + 1)],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }
}
