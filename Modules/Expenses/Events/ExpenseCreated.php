<?php

namespace Modules\Expenses\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Expenses\Domain\Models\Expense;

class ExpenseCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Expense $expense)
    {
    }
}
