<?php

namespace Modules\Expenses\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Modules\Expenses\Http\Requests\StoreExpenseRequest;
use Modules\Expenses\Http\Requests\UpdateExpenseRequest;
use Modules\Expenses\Http\Resources\ExpenseResource;
use Modules\Expenses\Http\Resources\ExpenseCollection;
use Modules\Expenses\Services\ExpenseService;
use Symfony\Component\HttpFoundation\Response;

class ExpenseController extends BaseController
{
    public function __construct(private readonly ExpenseService $service)
    {
    }

    public function index(Request $request)
    {
        $filters = $request->only(['category', 'date_from', 'date_to']);
        $perPage = (int) ($request->get('per_page', 15));
        $paginator = $this->service->list($filters, $perPage);
        return (new ExpenseCollection($paginator))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function show(string $id)
    {
        $expense = $this->service->get($id);
        if (!$expense) {
            return response()->json(['message' => 'Expense not found'], Response::HTTP_NOT_FOUND);
        }
        return (new ExpenseResource($expense))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function store(StoreExpenseRequest $request)
    {
        $expense = $this->service->create($request->validated());
        return (new ExpenseResource($expense))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateExpenseRequest $request, string $id)
    {
        $expense = $this->service->update($id, $request->validated());
        if (!$expense) {
            return response()->json(['message' => 'Expense not found'], Response::HTTP_NOT_FOUND);
        }
        return (new ExpenseResource($expense))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(string $id)
    {
        $deleted = $this->service->delete($id);
        if (!$deleted) {
            return response()->json(['message' => 'Expense not found'], Response::HTTP_NOT_FOUND);
        }
        return response()->noContent();
    }
}
