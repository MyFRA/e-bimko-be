<?php

namespace App\Repositories;

use App\Helpers\ModelFileUploadHelper;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeachersRepository
{
    public function findTeacherByMobileUserId($mobileUserId)
    {
        return Teacher::where('mobile_user_id', $mobileUserId)->first();
    }

    public function getALlTeachers()
    {
        return Teacher::get();
    }

    public function findByEmail($email)
    {
        return Teacher::where('email', $email)->first();
    }

    public function checkUserPasswordIsMatch($teacher, $plainPassword)
    {
        return Hash::check($plainPassword, $teacher->password);
    }

    public function updateProfilePictureByTeacherObj($requestFileProfilePicture, $teacherObj)
    {
        $teacherObj->update([
            'profile_pict' => ModelFileUploadHelper::modelFileUpdate($teacherObj, 'profile_pict', $requestFileProfilePicture)
        ]);

        return $teacherObj;
    }
}
