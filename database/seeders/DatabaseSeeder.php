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
        User::firstOrCreate([
            'email' => 'sajnushhossain.cse@gmail.com',
        ], [
            'name' => 'Sajnush',
            'password' => bcrypt('sajnush'),
        ]);

        Post::factory(10)->create();

        $this->call(CategoryTableSeeder::class);
    }
}