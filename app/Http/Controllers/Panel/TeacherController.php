<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Teacher\StoreRequest;
use App\Http\Requests\Panel\Teacher\UpdateRequest;
use App\Repositories\TeachersRepository;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    private $teacherRepository;
    private $mobileUserRepository;

    public function __construct()
    {
        if (!$this->teacherRepository) {
            $this->teacherRepository = new TeachersRepository();
        }
    }

    public function index()
    {
        $data = [
            'teachers' => $this->teacherRepository->getAllWithPaginationForAdminPanel()
        ];

        return view('panel.pages.teachers.index', $data);
    }

    public function create()
    {
        return view('panel.pages.teachers.create');
    }

    public function store(StoreRequest $request)
    {
        $this->teacherRepository->create($request);

        return redirect('/panel/teachers')->with('success', 'Data guru telah ditambahkan');
    }

    public function edit($teacherId)
    {
        $data = [
            'teacher' => $this->teacherRepository->findById($teacherId)
        ];

        return view('panel.pages.teachers.edit', $data);
    }

    public function update(UpdateRequest $request, $teacherId)
    {
        $teacher = $this->teacherRepository->findById($teacherId);

        if (!$teacher) {
            return abort(404);
        }

        $this->teacherRepository->updateteacherByObjFromAdminPanel($teacher, $request);

        return redirect('/panel/teachers')->with('success', 'Data guru telah diupdate');
    }

    public function destroy($teacherId)
    {
        $article = $this->teacherRepository->findById($teacherId);

        if (!$article) {
            return abort(404);
        }

        $this->teacherRepository->deleteByTeacherObj($article);

        return redirect('/panel/teachers')->with('success', 'Data guru telah dihapus');
    }

    public function resetDevice($id)
    {
        $teacher = $this->teacherRepository->findById($id);
        $mobileUser = $this->mobileUserRepository->findById($teacher->mobile_user_id);
        $this->mobileUserRepository->resetDeviceByMobileUserObj($mobileUser);

        return back()->with('success', 'Device guru ' . $teacher->name . ' telah di reset');
    }
}
