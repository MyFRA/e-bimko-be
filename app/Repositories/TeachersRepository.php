<?php

namespace App\Repositories;

use App\Models\Teacher;

class TeachersRepository
{

    public function getALlTeachers()
    {
        return Teacher::get();
    }
}
