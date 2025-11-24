<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            ['name' => 'Header Banner', 'slug' => 'header-banner'],
            ['name' => 'Sidebar Square', 'slug' => 'sidebar-square'],
            ['name' => '2x2 Grid Bottom', 'slug' => 'bottom-grid'],
            ['name' => 'Footer Banner', 'slug' => 'footer-banner'],
            ['name' => 'Middle Left', 'slug' => 'middle-left'],
            ['name' => 'Content Middle', 'slug' => 'content-middle'],
        ];

        $slugsToKeep = array_column($positions, 'slug');

        // Delete positions that are no longer in use
        DB::table('positions')->whereNotIn('slug', $slugsToKeep)->delete();

        foreach ($positions as $position) {
            Position::updateOrCreate(['slug' => $position['slug']], $position);
        }
    }
}
