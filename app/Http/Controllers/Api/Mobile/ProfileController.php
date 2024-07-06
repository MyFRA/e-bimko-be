<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Helpers\AuthHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\Profile\UpdateProfilePictureRequest;
use App\Repositories\StudentsRepository;
use App\Repositories\TeachersRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $studentRepository;
    private $teacherRepository;

    public function __construct()
    {
        if (!$this->studentRepository) {
            $this->studentRepository = new StudentsRepository();
        }

        if (!$this->teacherRepository) {
            $this->teacherRepository = new TeachersRepository();
        }
    }

    public function updateProfilePicture(UpdateProfilePictureRequest $request)
    {
        $mobileUser = AuthHelper::getCurrentAuthMobileUser();

        if ($mobileUser->role == 'student') {
            $student = $this->studentRepository->findStudentByMobileUserId($mobileUser->id);
            $student = $this->studentRepository->updateProfilePictureByStudentObj($request->file('profile_picture'), $student);
            $mobileUser->detail = $student;
        } else if ($mobileUser->role == 'teacher') {
            $teacher = $this->teacherRepository->findTeacherByMobileUserId($mobileUser->id);
            $teacher = $this->teacherRepository->updateProfilePictureByTeacherObj($request->file('profile_picture'), $teacher);
            $mobileUser->detail = $teacher;
        }

        return response()->json([
            'msg' => 'Profile picture updated',
            'data' => $mobileUser
        ]);
    }
}
