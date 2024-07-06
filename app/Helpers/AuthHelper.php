<?php

namespace App\Helpers;

use App\Repositories\MobileUserRepository;

class AuthHelper
{

    public static function getCurrentAuthMobileUser()
    {
        $nip_nisn = request()->header('x-nip_nisn');
        $deviceId = request()->header('x-device_id');

        $mobileUserRepo = new MobileUserRepository();
        $mobileUser = $mobileUserRepo->findByNipNisnAndDeviceId($nip_nisn, $deviceId);

        return $mobileUser;
    }
}
