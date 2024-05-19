<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $bookings = [
            [
                'name' => 'Projector',
                'start_time' => Carbon::now()->addHours(1),
                'end_time' => Carbon::now()->addHours(2),
                'booked_by' => 'John Doe',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Sound System',
                'start_time' => Carbon::now()->addHours(3),
                'end_time' => Carbon::now()->addHours(4),
                'booked_by' => 'Jane Smith',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('bookings')->insert($bookings);
    }
}
