<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(['slug' => 'tech'], ['name' => 'Tech']);
        Category::firstOrCreate(['slug' => 'sports'], ['name' => 'Sports']);
        Category::firstOrCreate(['slug' => 'politics'], ['name' => 'Politics']);
        Category::firstOrCreate(['slug' => 'economy'], ['name' => 'Economy']);
    }
}