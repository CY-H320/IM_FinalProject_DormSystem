<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('visitors')->insert([
            [
                'visitorName' => 'John Doe',
                'gender' => '男',
                'visit_time' => Carbon::now()->subHours(2),
                'exit_time' => Carbon::now()->subHour(),
                'student_id' => 'B12305001',
                'room' => '101',
                'bed' => 'A',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'visitorName' => 'Jane Smith',
                'gender' => '男',
                'visit_time' => Carbon::now()->subDays(1)->subHours(3),
                'exit_time' => Carbon::now()->subDays(1)->subHours(1),
                'student_id' => 'B11802025',
                'room' => '102',
                'bed' => 'B',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'visitorName' => 'Alice Johnson',
                'gender' => '其他',
                'visit_time' => Carbon::now()->subDays(2)->subHours(4),
                'exit_time' => Carbon::now()->subDays(2)->subHours(2),
                'student_id' => 'B11803025',
                'room' => '103',
                'bed' => 'C',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
