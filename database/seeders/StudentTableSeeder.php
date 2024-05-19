<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

class StudentTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('students')->delete();

        Student::create([
            'name' => '呂依涵',
            'studentID' => 'B12305001',
            'email' => 'lu@mail.com',
            'room' => '101',
            'bed' => 'A',
            'point' => '0',
            'description' => '',
        ],);
    }
}
