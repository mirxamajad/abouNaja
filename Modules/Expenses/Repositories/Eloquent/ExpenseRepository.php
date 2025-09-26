<?php

namespace Modules\Expenses\Repositories\Eloquent;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Expenses\Domain\Models\Expense;
use Modules\Expenses\Repositories\ExpenseRepositoryInterface;

class ExpenseRepository implements ExpenseRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Expense::query();

        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('expense_date', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('expense_date', '<=', $filters['date_to']);
        }

        return $query->orderByDesc('expense_date')->paginate($perPage);
    }

    public function find(string $id): ?Expense
    {
        return Expense::find($id);
    }

    public function create(array $data): Expense
    {
        return Expense::create($data);
    }

    public function update(Expense $expense, array $data): Expense
    {
        $expense->update($data);
        return $expense;
    }

    public function delete(Expense $expense): void
    {
        $expense->delete();
    }
}
