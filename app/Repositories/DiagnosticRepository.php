<?php

namespace App\Repositories;

use App\Models\Diagnostic;

class DiagnosticRepository
{

    public function get()
    {
        return Diagnostic::orderBy('id', 'ASC')->get();
    }
}
