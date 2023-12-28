<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\TaskStatus;
use App\Models\Task;
use App\Models\Label;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();
        User::factory()->create([
            'name' => 'test',
            'email' => 'test@t.t',
            'password' => Hash::make('testtest'),
        ]);
        TaskStatus::factory()->count(4)->sequence(
            ['name' => 'новая'],
            ['name' => 'завершена'],
            ['name' => 'выполняется'],
            ['name' => 'в архиве']
        )->create();
        Label::factory()->count(4)->sequence(
            ['name' => 'ошибка'],
            ['name' => 'документация'],
            ['name' => 'дупликат'],
            ['name' => 'доработка']
        )->create();

        Task::factory()->count(16)->sequence(
            fn() => ['status_id' => rand(1, 4), 'created_by_id' => rand(1, 10), 'assigned_to_id' => rand(1,10)]
        )->create();

        //create many-to-many relation between labels and tasks
        $labels = Label::all();
        Task::all()->each(function ($task) use ($labels) { 
            $task->labels()->attach($labels->random(rand(1, 3))->pluck('id')->toArray()); 
        });
    }
}
