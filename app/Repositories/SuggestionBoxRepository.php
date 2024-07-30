<?php

namespace App\Repositories;

use App\Models\SuggestionBox;

class SuggestionBoxRepository
{

    public function create($request)
    {
        return SuggestionBox::create([
            'suggestion'  => $request->suggestion
        ]);
    }
}
