<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Apply;
use App\Models\Blog;
use App\Models\Document;
use App\Models\SecondStatus;
use App\Models\status;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(100)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        status::create(['name' => 'Uploaded']);
        status::create(['name' => 'Received']);
        status::create(['name' => 'Review in Progress']);
        status::create(['name' => 'Continue to Interview Session']);
        status::create(['name' => 'Accepted']);
        status::create(['name' => 'Rejected']);

        Admin::create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        Admin::create([
            'email' => 'adminlkui@gmail.com',
            'password' => bcrypt('dinuspolke-123'),
        ]);

        Blog::factory(20)->create();

        // User::factory(50)->create();
        // Document::factory()->count(50)->create();
        // Apply::factory()->count(50)->create();
    }
}
