<?php

namespace Database\Seeders;

use App\Models\MobileUser;
use App\Models\Teacher;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mobileUser = MobileUser::create([
            'nip_nisn' => '54321',
            'role' => 'teacher',
            'device_id' => null
        ]);

        Teacher::create([
            'mobile_user_id' => $mobileUser->id,
            'name' => 'Udin',
            'gender' => 'Male',
            'dob' => '2002-09-21',
            'role' => 'Guru IPA',
            'profile_pict' => 'teacher.jpg'
        ]);
    }
}
