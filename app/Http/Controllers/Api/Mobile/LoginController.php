<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\Login\GetCurrentUserRequest;
use App\Http\Requests\Api\Mobile\Login\LoginRequest;
use App\Repositories\MobileUserRepository;
use App\Repositories\StudentsRepository;
use App\Repositories\TeachersRepository;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $studentRepository;

    private $teacherRepository;

    private $mobileUserRepository;

    public function __construct()
    {
        if (!$this->studentRepository) {
            $this->studentRepository = new StudentsRepository();
        }

        if (!$this->teacherRepository) {
            $this->teacherRepository = new TeachersRepository();
        }

        if (!$this->mobileUserRepository) {
            $this->mobileUserRepository = new MobileUserRepository();
        }
    }

    public function login(LoginRequest $request)
    {
        $mobileUser = $this->mobileUserRepository->findByNipNisn($request->nip_nisn);

        $mobileUser = $this->mobileUserRepository->updateDeviceIdByMobileUserObj($request->device_id, $mobileUser);


        if ($mobileUser->role == 'student') {
            $mobileUser->detail = $this->studentRepository->findStudentByMobileUserId($mobileUser->id);
        } else if ($mobileUser->role == 'teacher') {
            $mobileUser->detail = $this->teacherRepository->findTeacherByMobileUserId($mobileUser->id);
        }

        return response()->json([
            'msg' => 'Login Successfully',
            'data' => $mobileUser
        ]);
    }

    public function getCurrentUser(GetCurrentUserRequest $request)
    {
        $student = $this->mobileUserRepository->findByNipNisnAndDeviceId($request->nip_nisn, $request->device_id);

        return response()->json([
            'msg' => 'Current User Is Auth',
            'data' => $student
        ]);
    }
}
