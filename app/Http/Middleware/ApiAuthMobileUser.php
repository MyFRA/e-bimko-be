<?php

namespace App\Http\Middleware;

use App\Repositories\MobileUserRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMobileUser
{
    private $mobileUserRepository;

    public function __construct()
    {
        if (!$this->mobileUserRepository) {
            $this->mobileUserRepository = new MobileUserRepository();
        }
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->header('x-nip_nisn') || !$request->header('x-device_id')) {
            return response()->json([
                'msg' => 'Unauthenticated'
            ], 401);
        }

        $student = $this->mobileUserRepository->findByNipNisnAndDeviceId($request->header('x-nip_nisn'), $request->header('x-device_id'));
        if (!$student) {
            return response()->json([
                'msg' => 'Device ID Invalid'
            ], 401);
        }

        return $next($request);
    }
}
