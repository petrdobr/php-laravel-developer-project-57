<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\TaskStatus;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();
        TaskStatus::factory()->count(4)->sequence(
            ['name' => 'Выполнено'],
            ['name' => 'В работе'],
            ['name' => 'Архив'],
            ['name' => 'На тестировании']
        )->create();

        Task::factory()->count(16)->sequence(
            fn() => ['status_id' => rand(1, 4), 'created_by_id' => rand(1, 10), 'assigned_to_id' => rand(1,10)]
        )->create();

    }
}
