<?php

namespace Database\Seeders;

use App\Models\MobileUser;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mobileUser = MobileUser::create([
            'nip_nisn' => '12345',
            'role' => 'student',
            'device_id' => null
        ]);
        Student::create([
            'mobile_user_id' => $mobileUser->id,
            'name' => 'MyFRA',
            'gender' => 'Male',
            'dob' => '2002-09-21'
        ]);
    }
}
