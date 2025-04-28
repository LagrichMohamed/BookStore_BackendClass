<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Borrowing;

class ReturnBorrowingRequest extends FormRequest
{
    public function authorize(): bool
    {
        $borrowing = $this->route('borrowing');
        return auth()->check() &&
               ($borrowing->user_id === auth()->id() || auth()->user()->isAdmin()) &&
               !$borrowing->returned_at;
    }

    public function rules(): array
    {
        return [];
    }
}
