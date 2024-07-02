<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
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

    public function get()
    {
        return response()->json([
            'data' => $this->diagnosticRepository->get()
        ]);
    }
}
