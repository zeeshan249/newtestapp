<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [];

        for ($i = 1; $i <= 500; $i++) {
            $tasks[] = [
                'name' => 'Task '.$i,
                'email' => 'task'.$i.'@example.com',
                'phone' => '90000000'.str_pad($i, 2, '0', STR_PAD_LEFT),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('tasks')->insert($tasks);
    }
}
