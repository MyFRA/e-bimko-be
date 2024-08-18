<?php

namespace App\Repositories;

use App\Models\MobileApp;

class MobileAppRepository
{

    public function first()
    {
        return MobileApp::first();
    }

    public function update($request)
    {
        $mobileApp = $this->first();

        $mobileApp->update([
            'app_version' => $request->app_version,
            'app_url' => $request->app_url,
        ]);

        return $mobileApp;
    }
}
