<?php

namespace App\Http\Middleware;

use App\Repositories\StudentsRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthStudentMobile
{
    private $studentRepository;

    public function __construct()
    {
        if (!$this->studentRepository) {
            $this->studentRepository = new StudentsRepository();
        }
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->header('x-nisn') || !$request->header('x-device_id')) {
            return response()->json([
                'msg' => 'Unauthenticated'
            ], 401);
        }

        $student = $this->studentRepository->findStudentByNisnAndDeviceId($request->header('x-nisn'), $request->header('x-device_id'));
        if (!$student) {
            return response()->json([
                'msg' => 'Device ID Invalid'
            ], 401);
        }

        return $next($request);
    }
}
