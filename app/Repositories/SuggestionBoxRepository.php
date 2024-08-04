<?php

namespace App\Repositories;

use App\Models\SuggestionBox;

class SuggestionBoxRepository
{

    public function indexWithPaginationForPanel()
    {
        return SuggestionBox::orderBy('id', 'DESC')->paginate(10);
    }

    public function findById($id)
    {
        return SuggestionBox::find($id);
    }

    public function create($request)
    {
        return SuggestionBox::create([
            'suggestion'  => $request->suggestion
        ]);
    }

    public function updateToIsReadedTrueBySuggestionBoxObj($suggestionBox)
    {
        $suggestionBox->update([
            'is_readed' => true
        ]);

        return $suggestionBox;
    }

    public function countNotReadedSuggestionBox()
    {
        return SuggestionBox::where('is_readed', false)->count();
    }
}
