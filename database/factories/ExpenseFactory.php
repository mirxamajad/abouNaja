<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Expenses\Domain\Models\Expense;
use Modules\Expenses\Domain\Enums\ExpenseCategory;

/**
 * @extends Factory<Expense>
 */
class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    public function definition(): array
    {
        $categories = array_map(fn ($c) => $c->value, ExpenseCategory::cases());

        return [
            'title' => $this->faker->sentence(3),
            'amount' => $this->faker->randomFloat(2, 1, 5000),
            'category' => $this->faker->randomElement($categories),
            'expense_date' => $this->faker->dateTimeBetween('-90 days', 'now')->format('Y-m-d'),
            'notes' => $this->faker->boolean(60) ? $this->faker->sentence() : null,
        ];
    }
}
