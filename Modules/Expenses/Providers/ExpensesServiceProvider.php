<?php

namespace Modules\Expenses\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Modules\Expenses\Events\ExpenseCreated;
use Modules\Expenses\Listeners\SendExpenseCreatedNotification;
use Modules\Expenses\Repositories\ExpenseRepositoryInterface;
use Modules\Expenses\Repositories\Eloquent\ExpenseRepository;

class ExpensesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind repository
        $this->app->bind(ExpenseRepositoryInterface::class, ExpenseRepository::class);
    }

    public function boot(): void
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');

        // Register events
        Event::listen(
            ExpenseCreated::class,
            [SendExpenseCreatedNotification::class, 'handle']
        );
    }
}
