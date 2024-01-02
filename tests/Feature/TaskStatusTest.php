<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\Task;
use App\Models\User;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    public function testDisplay(): void
    {
        $response = $this->get('/task_statuses');

        $response->assertStatus(200);

        $user = User::factory()->make();

        $response = $this
            ->actingAs($user)
            ->get('/task_statuses');

        $response->assertOk();
    }

    public function testCreate(): void
    {
        //test guest cannot create
        $response = $this
        ->post('/task_statuses', [
            'name' => 'Test Status',
        ]);

        $response->assertStatus(403);

        //test user can create
        $user = User::factory()->make();

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

    public function testUpdate(): void
    {
        //test guest cannot update
        $user = User::factory()->make();
        $taskStatus = TaskStatus::factory()->create();
        $id = $taskStatus->id;

        $response = $this
        ->patch('/task_statuses/' . $id, [
            'name' => 'Test Status',
        ]);

        $response->assertStatus(403);

        //test user can update
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

    public function testDelete(): void
    {

        //test guest cannot delete
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();
        $id = $taskStatus->id;

        $response = $this
        ->delete('/task_statuses/' . $id);

        $response->assertStatus(403);

        //test logged in user can delete
        $response = $this
            ->actingAs($user)
            ->delete('/task_statuses/' . $id);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/task_statuses');

        $this->assertDatabaseMissing('task_statuses', [
            'id' => $id,
        ]);

        //test status with task connected to it cannot be deleted
        $taskStatus = TaskStatus::factory()->create();
        $id = $taskStatus->id;
        Task::factory()->create([
            'status_id' => $taskStatus->id,
            'created_by_id' => $user->id,
            'assigned_to_id' => $user->id
        ]);

        $response = $this
        ->actingAs($user)
        ->delete('/task_statuses/' . $id);

        $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/task_statuses');

        $this->assertDatabaseHas('task_statuses', [
            'name' => $taskStatus->name,
        ]);
    }
}
