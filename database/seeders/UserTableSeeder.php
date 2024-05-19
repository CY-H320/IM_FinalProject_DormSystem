<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name' => 'Tony',
            'email'    => 'tony@mail.com',
            'password' => 'dummy',
            'role' => 'admin',
        ]);
    }
}
