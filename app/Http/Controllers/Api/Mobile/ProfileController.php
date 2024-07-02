<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Helpers\AuthHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\Profile\UpdateProfilePictureRequest;
use App\Repositories\StudentsRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $studentRepository;

    public function __construct()
    {
        if (!$this->studentRepository) {
            $this->studentRepository = new StudentsRepository();
        }
    }

    public function updateProfilePicture(UpdateProfilePictureRequest $request)
    {
        $student = AuthHelper::getCurrentAuthStudent();

        $student = $this->studentRepository->updateProfilePictureByStudentObj($request->file('profile_picture'), $student);

        return response()->json([
            'msg' => 'Profile picture updated',
            'data' => $student
        ]);
    }
}
