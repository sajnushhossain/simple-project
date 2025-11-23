<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

class ProthomAloPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define some categories if they don't exist
        $categoriesData = [
            ['name' => 'National', 'slug' => 'national'],
            ['name' => 'Politics', 'slug' => 'politics'],
            ['name' => 'Economy', 'slug' => 'economy'],
            ['name' => 'International', 'slug' => 'international'],
            ['name' => 'Sports', 'slug' => 'sports'],
            ['name' => 'Opinion', 'slug' => 'opinion'],
            ['name' => 'Entertainment', 'slug' => 'entertainment'],
            ['name' => 'Tech & Science', 'slug' => 'tech-science'],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle'],
            ['name' => 'Education', 'slug' => 'education'],
        ];

        foreach ($categoriesData as $catData) {
            Category::firstOrCreate(['slug' => $catData['slug']], $catData);
        }

        $categories = Category::all();

        // Ensure there's at least one user to assign posts to
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Prothom Alo Author',
                'email' => 'author@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Clear existing posts to avoid duplicates if running multiple times
        Post::truncate();

        // Create posts for each category
        foreach ($categories as $category) {
            for ($i = 1; $i <= 5; $i++) { // Create 5 posts per category
                $title = "Sample Post " . $i . " for " . $category->name;
                Post::create([
                    'title' => $title,
                    'slug' => Str::slug($title),
                    'body' => 'This is the body of the sample post ' . $i . ' for ' . $category->name . '. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                    'image' => 'https://via.placeholder.com/640x480.png?text=' . urlencode($category->name . ' Post ' . $i),
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
