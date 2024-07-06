<?php

namespace App\Http\Controllers\Api\Mobile\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\Teacher\Auth\DoLoginRequest;
use App\Repositories\TeachersRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $teacherRepository;

    public function __construct()
    {
        if (!$this->teacherRepository) {
            $this->teacherRepository = new TeachersRepository();
        }
    }

    public function doLogin(DoLoginRequest $request)
    {
        $teacher = $this->teacherRepository->findByEmail($request->email);
        $passwordIsCorrect = $this->teacherRepository->checkUserPasswordIsMatch($teacher, $request->password);

        if (!$passwordIsCorrect) {
            return response()->json([
                "code" => 422,
                "msg" => "Error Validations",
                "error" => "Password Invalid"
            ], 422);
        }

        
    }
}
