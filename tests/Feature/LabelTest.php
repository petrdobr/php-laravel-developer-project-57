<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    public function testDisplay(): void
    {
        $response = $this->get('/labels');

        $response->assertStatus(200);

        $user = User::factory()->make();

        $response = $this
            ->actingAs($user)
            ->get('/labels');

        $response->assertOk();
    }
    
    public function testCreate(): void
    {
        //test guest cannot create
        $response = $this
        ->post('/labels', [
            'name' => 'Test Status',
            'description' => 'Test description'
        ]);

        $response->assertStatus(403);

        //test user can create
        $user = User::factory()->make();

        $response = $this
            ->actingAs($user)
            ->post('/labels', [
                'name' => 'Test Status',
                'description' => 'Test description'
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/labels');

        $this->assertDatabaseHas('labels', [
            'name' => 'Test Status',
        ]);
    }

    public function testUpdate(): void
    {
        $user = User::factory()->make();
        $label = Label::factory()->create();
        $id = $label->id;

        //test guest cannot update
        $response = $this
        ->patch('/labels/' . $id, [
            'name' => 'Test Status',
        ]);

        $response->assertStatus(403);

        //test user can update
        $response = $this
            ->actingAs($user)
            ->patch('/labels/' . $id, [
                'name' => 'Test Status',
            ]);

        $label->refresh();

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/labels');

        $this->assertSame('Test Status', $label->name);
    }

    public function testDelete(): void
    {

        //test guest cannot delete label
        $user = User::factory()->create();
        $label = Label::factory()->create();
        $id = $label->id;

        $response = $this
        ->delete('/labels/' . $id);

        $response->assertStatus(403);

        //test logged in user can delete label
        $response = $this
            ->actingAs($user)
            ->delete('/labels/' . $id);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/labels');

        $this->assertDatabaseMissing('labels', [
            'id' => $id,
        ]);

        //test label with task connected to it cannot be deleted
        $label = Label::factory()->create();
        $status = TaskStatus::factory()->create();
        $id = $label->id;
        $task = Task::factory()->create([
            'status_id' => $status->id,
            'created_by_id' => $user->id,
            'assigned_to_id' => $user->id
        ]);
        $task->labels()->attach($label->id);

        $response = $this
        ->actingAs($user)
        ->delete('/labels/' . $id);

        $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/labels');

        $this->assertDatabaseHas('labels', [
            'name' => $label->name,
        ]);

    }
}
