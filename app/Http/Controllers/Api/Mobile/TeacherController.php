<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Repositories\TeachersRepository;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    private $teacherRepository;

    public function __construct()
    {
        if (!$this->teacherRepository) {
            $this->teacherRepository = new TeachersRepository();
        }
    }

    public function get()
    {
        return response()->json([
            'msg' => 'Teachers succesfully loaded',
            'data' => $this->teacherRepository->getALlTeachers()
        ]);
    }
}
