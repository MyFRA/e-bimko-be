<?php

namespace App\Repositories;

use App\Helpers\ModelFileUploadHelper;
use App\Models\Student;

class StudentsRepository
{
    public function findStudentByMobileUserId($mobileUserId)
    {
        return Student::where('mobile_user_id', $mobileUserId)->first();
    }


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

    public function updateProfilePictureByStudentObj($requestFileProfilePicture, $studentObj)
    {
        $studentObj->update([
            'profile_pict' => ModelFileUploadHelper::modelFileUpdate($studentObj, 'profile_pict', $requestFileProfilePicture)
        ]);

        return $studentObj;
    }
}
