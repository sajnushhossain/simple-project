<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::truncate();
        Category::firstOrCreate(['slug' => 'tech'], ['name' => 'Tech']);
        Category::firstOrCreate(['slug' => 'sports'], ['name' => 'Sports']);
        Category::firstOrCreate(['slug' => 'economy'], ['name' => 'Economy']);
        Category::firstOrCreate(['slug' => 'entertainment'], ['name' => 'Entertainment']);
        Category::firstOrCreate(['slug' => 'jobs'], ['name' => 'Jobs']);
    }
}
