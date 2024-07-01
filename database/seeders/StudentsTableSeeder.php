<?php

namespace Database\Seeders;

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
        Student::create([
            'nisn' => 12345,
            'name' => 'MyFRA',
            'gender' => 'Male',
            'dob' => '2002-09-21'
        ]);
    }
}
