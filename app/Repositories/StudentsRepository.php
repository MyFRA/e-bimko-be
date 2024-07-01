<?php

namespace App\Repositories;

use App\Models\Student;

class StudentsRepository
{

    public function findStudentByNisn($nisn)
    {
        return Student::where('nisn', $nisn)->first();
    }

    public function updateDeviceIdByStudentObj($deviceId, $student)
    {
        $student->update([
            'device_id' => $deviceId
        ]);

        return $student;
    }

    public function findStudentByNisnAndDeviceId($nisn, $deviceId)
    {
        return Student::where('nisn', $nisn)
            ->where('device_id', $deviceId)
            ->first();
    }
}
