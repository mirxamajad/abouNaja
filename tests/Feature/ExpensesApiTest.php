<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExpensesApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_list_update_and_delete_expense(): void
    {
        // Create
        $create = $this->postJson('/api/expenses', [
            'title' => 'Lunch',
            'amount' => 12.50,
            'category' => 'food',
            'expense_date' => '2025-09-25',
            'notes' => 'Caesar salad',
        ]);
        $create->assertCreated();
        $expenseId = $create->json('data.id');

        // List
        $list = $this->getJson('/api/expenses');
        $list->assertOk()->assertJsonStructure([
            'data' => [
                ['id', 'title', 'amount', 'category', 'expense_date']
            ],
            'meta' => ['current_page', 'per_page', 'total', 'last_page']
        ]);

        // Show
        $show = $this->getJson("/api/expenses/{$expenseId}");
        $show->assertOk()->assertJsonPath('data.title', 'Lunch');

        // Update
        $update = $this->putJson("/api/expenses/{$expenseId}", [
            'title' => 'Team Lunch',
        ]);
        $update->assertOk()->assertJsonPath('data.title', 'Team Lunch');

        // Delete
        $delete = $this->deleteJson("/api/expenses/{$expenseId}");
        $delete->assertNoContent();

        // Show after delete
        $this->getJson("/api/expenses/{$expenseId}")->assertNotFound();
    }
}
