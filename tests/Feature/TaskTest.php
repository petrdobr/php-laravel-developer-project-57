<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use App\Models\Label;
use App\Models\TaskStatus;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_tasks_page_is_displayed(): void
    {
        $response = $this->get('/tasks');

        $response->assertStatus(200);

        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();
        $label = Label::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/tasks');

        $response->assertOk();

        $task = Task::factory()->create([
            'status_id' => $taskStatus->id,
            'created_by_id' => $user->id,
            'assigned_to_id' => $user->id
        ]);
        $response = $this->get('/tasks/' . $task->id);
        $response->assertStatus(200);
    }

    
    public function test_task_can_be_created(): void
    {
        
        $response = $this
        ->post('/tasks', [
            'name' => 'Test Status',
        ]);

        $response->assertStatus(403);
        
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();
        $label = Label::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/tasks', [
                'name' => 'Test Task',
                'description' => 'Test Description',
                'status_id' => $taskStatus->id,
                'created_by_id' => $user->id,
                'assigned_to_id' => $user->id,
                'labels' => $label->id,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/tasks');

        $this->assertDatabaseHas('tasks', [
            'name' => 'Test Task',
        ]);
    }

    public function test_task_can_be_updated(): void
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();
        $label = Label::factory()->create();
        
        $task = Task::factory()->create([
            'status_id' => $taskStatus->id,
            'created_by_id' => $user->id,
            'assigned_to_id' => $user->id
        ]);
        $task->labels()->attach($label->id);

        $id = $task->id;

        $response = $this
        ->patch('/tasks/' . $id, [
            'name' => 'Test Status',
            'labels' => $label->id,
        ]);

        $response->assertStatus(403);

        $response = $this
            ->actingAs($user)
            ->patch('/tasks/' . $id, [
                'name' => 'Test Task',
                'labels' => $label->id,
            ]);

        $task->refresh();

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/tasks/' . $id);

        $this->assertSame('Test Task', $task->name);
    }

    public function test_task_can_be_deleted(): void
    {
        $creator = User::factory()->create();
        $executor = User::factory()->create();
        $label = Label::factory()->create();
        $taskStatus = TaskStatus::factory()->create();
        $task = Task::factory()->create([
            'status_id' => $taskStatus->id,
            'created_by_id' => $creator->id,
            'assigned_to_id' => $executor->id
        ]);
        $task->labels()->attach($label->id);
        $id = $task->id;

        $response = $this->delete('/tasks/' . $id);

        $response->assertStatus(403);

        $response = $this->actingAs($executor)
            ->delete('/tasks/' . $id);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
        ]);

        $response = $this->actingAs($creator)
            ->delete('/tasks/' . $id);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/tasks');

        $this->assertDatabaseMissing('tasks', [
            'id' => $id,
        ]);
    }
}
