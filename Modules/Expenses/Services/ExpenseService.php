<?php

namespace Modules\Expenses\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Expenses\Domain\Models\Expense;
use Modules\Expenses\Events\ExpenseCreated;
use Modules\Expenses\Repositories\ExpenseRepositoryInterface;

class ExpenseService
{
    public function __construct(private readonly ExpenseRepositoryInterface $repo)
    {
    }

    public function list(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->repo->paginate($filters, $perPage);
    }

    public function get(string $id): ?Expense
    {
        return $this->repo->find($id);
    }

    public function create(array $data): Expense
    {
        $expense = $this->repo->create($data);
        event(new ExpenseCreated($expense));
        return $expense;
    }

    public function update(string $id, array $data): ?Expense
    {
        $expense = $this->repo->find($id);
        if (!$expense) {
            return null;
        }
        return $this->repo->update($expense, $data);
    }

    public function delete(string $id): bool
    {
        $expense = $this->repo->find($id);
        if (!$expense) {
            return false;
        }
        $this->repo->delete($expense);
        return true;
    }
}
