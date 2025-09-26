<?php

namespace Modules\Expenses\Listeners;

use Illuminate\Support\Facades\Log;
use Modules\Expenses\Events\ExpenseCreated;

class SendExpenseCreatedNotification
{
    public function handle(ExpenseCreated $event): void
    {
        // For demo: just log the event. Could be extended to email/db notifications.
        Log::info('Expense created', [
            'id' => $event->expense->id,
            'title' => $event->expense->title,
            'amount' => $event->expense->amount,
            'category' => $event->expense->category,
            'expense_date' => $event->expense->expense_date?->toDateString(),
        ]);
    }
}
