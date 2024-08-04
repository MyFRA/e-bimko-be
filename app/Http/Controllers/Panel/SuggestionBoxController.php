<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
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


    public function index()
    {
        $data = [
            'messages' => $this->suggestionBoxRepository->indexWithPaginationForPanel()
        ];

        return view('panel.pages.suggestion-box.index', $data);
    }

    public function show($id)
    {
        $suggestionBox = $this->suggestionBoxRepository->findById($id);
        $this->suggestionBoxRepository->updateToIsReadedTrueBySuggestionBoxObj($suggestionBox);

        $data = [
            'suggestionBox' => $suggestionBox
        ];

        return view('panel.pages.suggestion-box.show', $data);
    }
}
