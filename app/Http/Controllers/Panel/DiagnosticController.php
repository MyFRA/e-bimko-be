<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Diagnostic\UpdateRequest;
use App\Repositories\DiagnosticRepository;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    private $diagnosticRepository;

    public function __construct()
    {
        if (!$this->diagnosticRepository) {
            $this->diagnosticRepository = new DiagnosticRepository();
        }
    }


    public function index()
    {
        $data = [
            'diagnostics' => $this->diagnosticRepository->get()
        ];

        return view('panel.pages.diagnostics.index', $data);
    }

    public function edit($diagnosticId)
    {
        $diagnostic = $this->diagnosticRepository->findById($diagnosticId);

        if (!$diagnostic) {
            return abort(404);
        }

        $data = [
            'diagnostic' => $diagnostic
        ];

        return view('panel.pages.diagnostics.edit', $data);
    }

    public function update(UpdateRequest $request, $diagnosticId)
    {
        $diagnostic = $this->diagnosticRepository->findById($diagnosticId);

        if (!$diagnostic) {
            return abort(404);
        }

        $this->diagnosticRepository->updateByDiagnostictObj($diagnostic, $request);

        return redirect('/panel/diagnostics')->with('success', 'Data diagnostik telah diupdate');
    }
}
