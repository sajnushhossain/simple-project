<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'sajnushhossain.cse@gmail.com'],
            [
                'name' => 'SAJ',
                'password' => Hash::make('sajnush'),
                'role' => 'admin',
            ]
        );
    }
}
