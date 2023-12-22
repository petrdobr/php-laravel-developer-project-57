<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\User;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_statuses_page_is_displayed(): void
    {
        $response = $this->get('/task_statuses');

        $response->assertStatus(200);

        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/task_statuses');

        $response->assertOk();
    }

    
    public function test_task_status_can_be_created(): void
    {
        
        $response = $this
        ->post('/task_statuses', [
            'name' => 'Test Status',
        ]);

        $response->assertStatus(403);
        
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/task_statuses', [
                'name' => 'Test Status',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/task_statuses');

        $this->assertDatabaseHas('task_statuses', [
            'name' => 'Test Status',
        ]);
    }

    public function test_task_status_can_be_updated(): void
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();
        $id = $taskStatus->id;

        $response = $this
        ->patch('/task_statuses/' . $id, [
            'name' => 'Test Status',
        ]);

        $response->assertStatus(403);

        $response = $this
            ->actingAs($user)
            ->patch('/task_statuses/' . $id, [
                'name' => 'Test Status',
            ]);

        $taskStatus->refresh();

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/task_statuses');

        $this->assertSame('Test Status', $taskStatus->name);
    }

    public function test_task_status_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();
        $id = $taskStatus->id;

        $response = $this
        ->delete('/task_statuses/' . $id);

        $response->assertStatus(403);

        $response = $this
            ->actingAs($user)
            ->delete('/task_statuses/' . $id);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/task_statuses');

                $this->assertDatabaseMissing('task_statuses', [
            'id' => $id,
        ]);
    }
}
