<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Admin::factory(10)->create();

         \App\Models\Admin::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'rol' => strtolower('Admin'),
         ]);

         Category::factory(4)->create();
         Project::factory(10)->create();
    }
}
