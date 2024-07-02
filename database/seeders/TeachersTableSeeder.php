<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $faker = Factory::create('id_ID');

            Teacher::create([
                'name' => $faker->name,
                'role' => $faker->jobTitle(),
                'photo' => 'teacher.jpg'
            ]);
        }
    }
}
