<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Student\StoreRequest;
use App\Http\Requests\Panel\Student\UpdateRequest;
use App\Repositories\MobileUserRepository;
use App\Repositories\StudentsRepository;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $studentRepository;
    private $mobileUserRepository;

    public function __construct()
    {
        if (!$this->studentRepository) {
            $this->studentRepository = new StudentsRepository();
        }

        if (!$this->mobileUserRepository) {
            $this->mobileUserRepository = new MobileUserRepository();
        }
    }

    public function index()
    {
        $data = [
            'students' => $this->studentRepository->getAllWithPaginationForAdminPanel()
        ];

        return view('panel.pages.students.index', $data);
    }

    public function create()
    {
        return view('panel.pages.students.create');
    }

    public function store(StoreRequest $request)
    {
        $this->studentRepository->create($request);

        return redirect('/panel/students')->with('success', 'Data siswa telah ditambahkan');
    }

    public function edit($studentId)
    {
        $data = [
            'student' => $this->studentRepository->findById($studentId)
        ];

        return view('panel.pages.students.edit', $data);
    }

    public function update(UpdateRequest $request, $studentId)
    {
        $student = $this->studentRepository->findById($studentId);

        if (!$student) {
            return abort(404);
        }

        $this->studentRepository->updateStudentByObjFromAdminPanel($student, $request);

        return redirect('/panel/students')->with('success', 'Data siswa telah diupdate');
    }

    public function destroy($studentId)
    {
        $article = $this->studentRepository->findById($studentId);

        if (!$article) {
            return abort(404);
        }

        $this->studentRepository->deleteByStudentObj($article);

        return redirect('/panel/students')->with('success', 'Data siswa telah dihapus');
    }

    public function resetDevice($id)
    {
        $student = $this->studentRepository->findById($id);
        $mobileUser = $this->mobileUserRepository->findById($student->mobile_user_id);
        $this->mobileUserRepository->resetDeviceByMobileUserObj($mobileUser);

        return back()->with('success', 'Device siswa ' . $student->name . ' telah di reset');
    }
}
