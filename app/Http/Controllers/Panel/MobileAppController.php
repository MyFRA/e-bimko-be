<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\MobileApp\UpdateRequest;
use App\Repositories\MobileAppRepository;
use Illuminate\Http\Request;

class MobileAppController extends Controller
{
    private $mobileAppRepository;

    public function __construct()
    {
        if (!$this->mobileAppRepository) {
            $this->mobileAppRepository = new MobileAppRepository();
        }
    }

    public function edit()
    {
        $data = [
            'mobileApp' => $this->mobileAppRepository->first()
        ];

        return view('panel.pages.mobile-app.edit', $data);
    }

    public function update(UpdateRequest $request)
    {
        $this->mobileAppRepository->update($request);

        return back()->with('success', 'Konfigurasi Aplikasi telah di update');
    }
}
