<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
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

    public function index()
    {
        return response()->json([
            'data' => $this->mobileAppRepository->first()
        ]);
    }
}
