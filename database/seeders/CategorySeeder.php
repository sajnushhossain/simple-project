<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(['slug' => 'latest'], ['name' => 'সর্বশেষ']);
        Category::firstOrCreate(['slug' => 'bangladesh'], ['name' => 'বাংলাদেশ']);
        Category::firstOrCreate(['slug' => 'politics'], ['name' => 'রাজনীতি']);
        Category::firstOrCreate(['slug' => 'world'], ['name' => 'বিশ্ব']);
        Category::firstOrCreate(['slug' => 'business'], ['name' => 'বাণিজ্য']);
        Category::firstOrCreate(['slug' => 'opinion'], ['name' => 'মতামত']);
        Category::firstOrCreate(['slug' => 'sports'], ['name' => 'খেলা']);
        Category::firstOrCreate(['slug' => 'entertainment'], ['name' => 'বিনোদন']);
        Category::firstOrCreate(['slug' => 'jobs'], ['name' => 'চাকরি']);
        Category::firstOrCreate(['slug' => 'lifestyle'], ['name' => 'জীবনধারা']);
        Category::firstOrCreate(['slug' => 'video'], ['name' => 'ভিডিও']);
    }
}
