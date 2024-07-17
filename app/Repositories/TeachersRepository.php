<?php

namespace App\Repositories;

use App\Helpers\ModelFileUploadHelper;
use App\Models\MobileUser;
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

    public function findById($teacherId)
    {
        return Teacher::find($teacherId);
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

    public function getAllWithPaginationForAdminPanel()
    {
        return Teacher::paginate(10);
    }

    public function create($request)
    {
        $mobileUser = MobileUser::create([
            'nip_nisn' => $request->nip,
            'role' => 'teacher'
        ]);

        $teacher = Teacher::create([
            'mobile_user_id' => $mobileUser->id,
            'name' => $request->name,
            'gender' => $request->gender,
            'profile_pict' => ModelFileUploadHelper::modelFileStore('teachers', 'profile_pict', $request->file('profile_pict'))
        ]);

        return $teacher;
    }

    public function updateteacherByObjFromAdminPanel($teacher, $request)
    {
        $teacher->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'profile_pict' => ModelFileUploadHelper::modelFileUpdate($teacher, 'profile_pict', $request->file('profile_pict'))
        ]);

        $teacher->mobileUser->update([
            'nip_nisn' => $request->nip
        ]);

        return $teacher;
    }

    public function deleteByTeacherObj($teacherObj)
    {
        ModelFileUploadHelper::modelFileDelete($teacherObj, 'profile_pict');
        $teacherObj->delete();
    }
}
