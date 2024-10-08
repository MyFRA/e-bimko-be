<?php

namespace App\Repositories;

use App\Models\MobileUser;

class MobileUserRepository
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

    public function findByNipNisn($nip_nisn)
    {
        $mobileUser = MobileUser::where('nip_nisn', $nip_nisn)
            ->first();

        return $mobileUser;
    }

    public function findByNipNisnAndDeviceId($nip_nisn, $deviceId)
    {
        $mobileUser = MobileUser::where('nip_nisn', $nip_nisn)
            ->where('device_id', $deviceId)
            ->first();

        return $mobileUser;
    }

    public function updateDeviceIdAndFcmTokenByMobileUserObj($deviceId, $fcmToken, $mobileUser)
    {
        $mobileUser->where('fcm_token', $fcmToken)->where('device_id', '!=', $deviceId)->update([
            'fcm_token' => 'null'
        ]);

        $mobileUser->update([
            'device_id' => $deviceId,
            'fcm_token' => $fcmToken
        ]);

        return $mobileUser;
    }

    public function checkIsDeviceIdExistsInDB($deviceId)
    {
        return MobileUser::where('device_id', $deviceId)->first() != null;
    }

    public function findById($id)
    {
        return MobileUser::find($id);
    }

    public function resetDeviceByMobileUserObj($mobileUser)
    {
        $mobileUser->update([
            'device_id' => null,
            'fcm_token' => null
        ]);
    }
}
