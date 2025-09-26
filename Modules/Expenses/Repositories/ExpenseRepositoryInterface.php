<?php

namespace Modules\Expenses\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Expenses\Domain\Models\Expense;

interface ExpenseRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    public function find(string $id): ?Expense;

    public function create(array $data): Expense;

    public function update(Expense $expense, array $data): Expense;

    public function delete(Expense $expense): void;
}
