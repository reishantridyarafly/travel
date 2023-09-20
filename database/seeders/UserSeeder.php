<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = User::create([
            'name' => 'Owner',
            'username' => 'owner',
            'no_hp' => '083123456729',
            'email' => 'owner@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234567890'),
        ]);

        $owner->assignRole('owner');

        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'no_hp' => '083123456789',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234567890'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User',
            'username' => 'user',
            'no_hp' => '083123456789',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234567890'),
        ]);

        $user->assignRole('user');
    }
}
