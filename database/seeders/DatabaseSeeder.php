<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Employer Role',
            'email' => 'employer@test.com',
            'password' => Hash::make('employer123'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Seeker Role',
            'email' => 'seeker@test.com',
            'password' => Hash::make('seeker123'),
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Moderator Role',
            'email' => 'moderator@test.com',
            'password' => Hash::make('moderator123'),
            'role_id' => 3,
        ]);
    }
}
