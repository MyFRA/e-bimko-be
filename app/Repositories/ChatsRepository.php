<?php

namespace App\Repositories;

use App\Models\Chat;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChatsRepository
{
    public function getChatByStudentIdAndTeacherId($studentId, $teacherId)
    {
        $chats = Chat::select('chats.*', DB::raw('DATE(created_at) as date'))
            ->where('student_id', $studentId)
            ->where('teacher_id', $teacherId)
            ->orderBy('created_at', 'ASC')
            ->get();

        $dates = Chat::select(DB::raw('DATE(created_at) as date'))
            ->where('student_id', $studentId)
            ->where('teacher_id', $teacherId)
            ->orderBy('created_at', 'ASC')
            ->groupBy('date')
            ->pluck('date');

        return $dates->map(function ($date) use ($chats) {
            return [
                'date' => $date,
                'chats' => array_values($chats->filter(function ($e) use ($date) {
                    return $date == $e->date;
                })->toArray())
            ];
        });
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
