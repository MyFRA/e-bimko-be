<?php

namespace App\Helpers;

use App\Repositories\StudentsRepository;

class AuthHelper
{

    public static function getCurrentAuthStudent()
    {
        $nisn = request()->header('x-nisn');
        $deviceId = request()->header('x-device_id');

        $studentRepository = new StudentsRepository();
        $student = $studentRepository->findStudentByNisnAndDeviceId($nisn, $deviceId);

        return $student;
    }
}
