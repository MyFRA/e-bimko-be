<?php

namespace App\Repositories;

use App\Helpers\ModelFileUploadHelper;
use App\Models\MobileUser;
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

    public function getAllWithPaginationForAdminPanel()
    {
        return Student::paginate(10);
    }

    public function findById($studentId)
    {
        return Student::find($studentId);
    }

    public function create($request)
    {
        $mobileUser = MobileUser::create([
            'nip_nisn' => $request->nisn,
            'role' => 'student'
        ]);

        $student = Student::create([
            'mobile_user_id' => $mobileUser->id,
            'name' => $request->name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'academic_year' => "$request->academic_year_start/$request->academic_year_end",
            'profile_pict' => ModelFileUploadHelper::modelFileStore('students', 'profile_pict', $request->file('profile_pict'))
        ]);

        return $student;
    }

    public function updateStudentByObjFromAdminPanel($student, $request)
    {
        $student->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'academic_year' => "$request->academic_year_start/$request->academic_year_end",
            'profile_pict' => ModelFileUploadHelper::modelFileUpdate($student, 'profile_pict', $request->file('profile_pict'))
        ]);

        $student->mobileUser->update([
            'nip_nisn' => $request->nisn
        ]);

        return $student;
    }

    public function deleteByStudentObj($student)
    {
        ModelFileUploadHelper::modelFileDelete($student, 'profile_pict');
        $student->delete();
    }
}
