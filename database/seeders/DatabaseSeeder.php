<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(RegularUserSeeder::class);
        $this->call(CategoryTableSeeder::class);
        \App\Models\Post::factory(10)->create();
    }
}