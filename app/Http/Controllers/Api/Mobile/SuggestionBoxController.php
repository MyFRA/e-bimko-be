<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\SuggestionBox\SubmitSuggestionBoxRequest;
use App\Repositories\SuggestionBoxRepository;
use Illuminate\Http\Request;

class SuggestionBoxController extends Controller
{
    private $suggestionBoxRepository;

    public function __construct()
    {
        if (!$this->suggestionBoxRepository) {
            $this->suggestionBoxRepository = new SuggestionBoxRepository();
        }
    }

    public function submitSuggestionBox(SubmitSuggestionBoxRequest $request)
    {
        $suggestionBox = $this->suggestionBoxRepository->create($request);

        return response()->json([
            'msg' => 'Suggestion Box Created',
            'data' => $suggestionBox
        ]);
    }
}
