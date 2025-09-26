<?php

namespace Modules\Expenses\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Expenses\Domain\Enums\ExpenseCategory;

class StoreExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'string', 'in:'.implode(',', array_map(fn ($c) => $c->value, ExpenseCategory::cases()))],
            'expense_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
