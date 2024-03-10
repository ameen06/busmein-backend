<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "Ameen",
            'email' => "ameen@test.in",
            'phone' => "919946264717",
        ]);

        DB::table('admins')->insert([
            'name' => "admin",
            'email' => "ameen@humblar.in",
            'password' => Hash::make('Password'),
        ]);
    }
}
