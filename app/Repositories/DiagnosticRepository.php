<?php

namespace App\Repositories;

use App\Helpers\ModelFileUploadHelper;
use App\Models\Diagnostic;

class DiagnosticRepository
{

    public function get()
    {
        return Diagnostic::orderBy('id', 'ASC')->get();
    }

    public function findById($id)
    {
        return Diagnostic::find($id);
    }

    public function updateByDiagnostictObj($diagnostic, $request)
    {
        $diagnostic->update([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'thumbnail' => ModelFileUploadHelper::modelFileUpdate($diagnostic, 'thumbnail', $request->file('thumbnail')),
        ]);

        return $diagnostic;
    }
}
