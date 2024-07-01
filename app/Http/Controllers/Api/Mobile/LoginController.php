<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\Login\GetCurrentUserRequest;
use App\Http\Requests\Api\Mobile\Login\LoginRequest;
use App\Repositories\StudentsRepository;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $studentRepository;

    public function __construct()
    {
        if (!$this->studentRepository) {
            $this->studentRepository = new StudentsRepository();
        }
    }

    public function login(LoginRequest $request)
    {
        $student = $this->studentRepository->findStudentByNisn($request->nisn);

        $this->studentRepository->updateDeviceIdByStudentObj($request->device_id, $student);

        return response()->json([
            'msg' => 'Login Successfully',
            'data' => $student
        ]);
    }

    public function getCurrentUser(GetCurrentUserRequest $request)
    {
        $student = $this->studentRepository->findStudentByNisnAndDeviceId($request->nisn, $request->device_id);

        return response()->json([
            'msg' => 'Current User Is Auth',
            'data' => $student
        ]);
    }
}
