<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Helpers\TelegramBotHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\Login\GetCurrentUserRequest;
use App\Http\Requests\Api\Mobile\Login\LoginRequest;
use App\Repositories\MobileUserRepository;
use App\Repositories\StudentsRepository;
use App\Repositories\TeachersRepository;
use DateTime;
use DateTimeZone;
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

        $mobileUser = $this->mobileUserRepository->updateDeviceIdAndFcmTokenByMobileUserObj($request->device_id, $request->fcm_token, $mobileUser);

        if ($mobileUser->role == 'student') {
            $mobileUser->detail = $this->studentRepository->findStudentByMobileUserId($mobileUser->id);
        } else if ($mobileUser->role == 'teacher') {
            $mobileUser->detail = $this->teacherRepository->findTeacherByMobileUserId($mobileUser->id);
        }

        $dt = new DateTime();
        $dt->setTimezone(new DateTimeZone('Asia/Jakarta'));
        $dt->setTimestamp(time());

        TelegramBotHelper::sendMessage(
            "
*New Login Access Detected*

NIP/NISN        : " . $request->nip_nisn . "
Device Name  : " . str_replace('_', '-', request()->device_name) . "
Device ID         : " . $request->device_id . "
DateTime        : " . $dt->format('Y-m-d H:i:s') . "
Status              : ✅ *Success*
Description     : -
            "
        );

        return response()->json([
            'msg' => 'Login Successfully',
            'data' => $mobileUser
        ]);
    }

    public function getCurrentUser(GetCurrentUserRequest $request)
    {
        $mobileUser = $this->mobileUserRepository->findByNipNisnAndDeviceId($request->nip_nisn, $request->device_id);

        if ($mobileUser->role == 'student') {
            $mobileUser->detail = $this->studentRepository->findStudentByMobileUserId($mobileUser->id);
        } else if ($mobileUser->role == 'teacher') {
            $mobileUser->detail = $this->teacherRepository->findTeacherByMobileUserId($mobileUser->id);
        }

        return response()->json([
            'msg' => 'Current User Is Auth',
            'data' => $mobileUser
        ]);
    }
}
