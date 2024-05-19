<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use Faker\Factory as Faker;

class PackageSeeder extends Seeder
{
    public function run()
    {
        // Create Faker instance
        $faker = Faker::create();

        // Define number of packages to create
        $numberOfPackages = 10;

        // Define possible room and bed values
        $rooms = ['101', '102', '103', '104', '105', '201', '202', '203', '204', '205'];
        $beds = ['A', 'B', 'C', 'D'];
        $error = ['0', '1'];

        // Generate and insert sample data
        for ($i = 0; $i < $numberOfPackages; $i++) {
            Package::create([
                'date' => $faker->date,
                'room' => $faker->randomElement($rooms),
                'bed' => $faker->randomElement($beds),
                'name' => $faker->name,
                'error' => $faker->randomElement($error),
            ]);
        }
    }
}
