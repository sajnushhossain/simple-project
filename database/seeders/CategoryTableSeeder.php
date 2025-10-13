<?php

namespace Database\Seeders;

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
        DB::table('categories')->insert([
            ['name' => 'Tech', 'slug' => 'tech'],
            ['name' => 'Sports', 'slug' => 'sports'],
            ['name' => 'Politics', 'slug' => 'politics'],
            ['name' => 'Economy', 'slug' => 'economy'],
        ]);
    }
}