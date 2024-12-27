<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $task = Task::factory()->create([
                'author_id' => $user->id,
            ]);

            $randomUser = $users->random()->id;

            $task->assignedUsers()->attach($randomUser);
        }
    }
}
