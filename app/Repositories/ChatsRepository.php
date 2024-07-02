<?php

namespace App\Repositories;

use App\Models\Chat;

class ChatsRepository
{
    public function getChatByStudentIdAndTeacherId($studentId, $teacherId)
    {
        return Chat::where('student_id', $studentId)
            ->where('teacher_id', $teacherId)
            ->orderBy('created_at', 'ASC')
            ->get();
    }

    public function studentObjCreateChat($studentObj, $request)
    {
        return Chat::create([
            'teacher_id' => $request->teacher_id,
            'student_id' => $studentObj->id,
            'sender' => 'student',
            'chat' => $request->chat,
        ]);
    }
}
