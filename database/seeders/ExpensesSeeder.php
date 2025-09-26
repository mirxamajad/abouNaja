<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Expenses\Domain\Models\Expense;

class ExpensesSeeder extends Seeder
{
    /**
     * Seed the application's database with demo expenses.
     */
    public function run(): void
    {
        Expense::factory()->count(50)->create();
    }
}
