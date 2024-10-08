<?php

namespace App\Repositories;

use App\Models\Chat;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChatsRepository
{

    private $mobileUserRepository;
    private $studentRepository;
    private $teacherRepository;

    public function __construct()
    {
        if (!$this->mobileUserRepository) {
            $this->mobileUserRepository = new MobileUserRepository();
        }

        if (!$this->studentRepository) {
            $this->studentRepository = new StudentsRepository();
        }

        if (!$this->teacherRepository) {
            $this->teacherRepository = new TeachersRepository();
        }
    }

    public function sendChatFromMobileUserToOpponentMobileUserId($mobileUser, $opponentMobileUserId, $request)
    {
        $opponentMobileUser = $this->mobileUserRepository->findById($opponentMobileUserId);

        return Chat::create([
            'teacher_id' => $mobileUser->role == 'teacher' ? $mobileUser->teacher->id : $opponentMobileUser->teacher->id,
            'student_id' => $mobileUser->role == 'student' ? $mobileUser->student->id : $opponentMobileUser->student->id,
            'sender' => $mobileUser->role,
            'chat' => $request->chat,
        ]);
    }

    public function getChatByMobileUserAndMobileUserOpponentId($mobileUser, $mobileUserOpponentId, $page)
    {
        $studentMobileUserId = $mobileUser->role == 'student' ? $mobileUser->id : $mobileUserOpponentId;
        $teacherMobileUserId = $mobileUser->role == 'teacher' ? $mobileUser->id : $mobileUserOpponentId;

        $chats = Chat::select('chats.*', DB::raw('DATE(chats.created_at) as date'), DB::raw("date_format(chats.created_at, '%H:%i') as hour"))
            ->leftJoin('students', 'students.id', '=', 'chats.student_id')
            ->leftJoin('teachers', 'teachers.id', '=', 'chats.teacher_id')
            ->where('students.mobile_user_id', $studentMobileUserId)
            ->where('teachers.mobile_user_id', $teacherMobileUserId)
            ->orderBy('chats.id', 'DESC')
            ->skip($page == 1 ? 0 : ($page - 1) * 5)
            ->take(5)
            ->get();

        if (count($chats)  == 0) {
            $dates = collect([]);
        } else {
            $dates = Chat::select(DB::raw('DATE(chats.created_at) as date'))
                ->leftJoin('students', 'students.id', '=', 'chats.student_id')
                ->leftJoin('teachers', 'teachers.id', '=', 'chats.teacher_id')
                ->where('students.mobile_user_id', $studentMobileUserId)
                ->where('teachers.mobile_user_id', $teacherMobileUserId)
                ->where('chats.id', '<=', $chats[0]->id)
                ->where('chats.id', '>=', $chats[count($chats) - 1]->id)
                ->orderBy('chats.id', 'DESC')
                ->groupBy('date')
                ->pluck('date');
        }

        return $dates->map(function ($date) use ($chats) {
            return [
                'date' => $date,
                'chats' => array_values($chats->filter(function ($e) use ($date) {
                    return $date == $e->date;
                })->reverse()->values()->all())
            ];
        })->reverse()->values()->all();
    }

    public function getChatByMobileUserAndMobileUserOpponentIdAndAfterChatId($mobileUser, $mobileUserOpponentId, $chatId)
    {
        $studentMobileUserId = $mobileUser->role == 'student' ? $mobileUser->id : $mobileUserOpponentId;
        $teacherMobileUserId = $mobileUser->role == 'teacher' ? $mobileUser->id : $mobileUserOpponentId;

        $chats = Chat::select('chats.*', DB::raw('DATE(chats.created_at) as date'))
            ->leftJoin('students', 'students.id', '=', 'chats.student_id')
            ->leftJoin('teachers', 'teachers.id', '=', 'chats.teacher_id')
            ->where('students.mobile_user_id', $studentMobileUserId)
            ->where('teachers.mobile_user_id', $teacherMobileUserId)
            ->where('chats.id', '>', $chatId)
            ->orderBy('chats.created_at', 'ASC')
            ->get();

        $dates = Chat::select(DB::raw('DATE(chats.created_at) as date'))
            ->leftJoin('students', 'students.id', '=', 'chats.student_id')
            ->leftJoin('teachers', 'teachers.id', '=', 'chats.teacher_id')
            ->where('students.mobile_user_id', $studentMobileUserId)
            ->where('teachers.mobile_user_id', $teacherMobileUserId)
            ->where('chats.id', '>', $chatId)
            ->orderBy('chats.created_at', 'ASC')
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

    public function getAllChatGroupedForMobileUserByMobileUser($mobileUser)
    {
        $lv1GroupBy = $mobileUser->role == 'student' ? 'chats.teacher_id' : 'chats.student_id';
        $lv1OpponentName = $mobileUser->role == 'student' ? 'teachers.name' : 'students.name';
        $lv1OpponentMobileUserId = $mobileUser->role == 'student' ? 'teachers.mobile_user_id' : 'students.mobile_user_id';
        $lv1OpponentProfilePict = $mobileUser->role == 'student' ? "CONCAT('" . url('/storage/teachers/profile-pict/') . '/' . "', teachers.profile_pict)" : "CONCAT('" . url('/storage/students/profile-pict/') . '/' . "', students.profile_pict)";
        $lv1OpponentRole = $mobileUser->role == 'student' ? "'teacher'" : "'student'";
        $lv2WhereColMobileUserId = $mobileUser->role == "student" ? "students_lv2.mobile_user_id" : "teachers_lv2.mobile_user_id";

        $chats = DB::select(
            "SELECT " .
                $lv1GroupBy . ' as opponent_student_or_teacher_id ' . ", " .
                $lv1OpponentName . ", " .
                $lv1OpponentProfilePict . " as profile_pict_url, " .
                $lv1OpponentRole . " as role, " .
                $lv1OpponentMobileUserId  . " as mobile_user_id, " .
                $this->getOneColumnFromSubqueryGetAllChatGroupedForMobileUserByMobileUser('chats_lv2.chat', 'chat', $lv1GroupBy, $lv2WhereColMobileUserId, $mobileUser) . " , " .
                $this->getOneColumnFromSubqueryGetAllChatGroupedForMobileUserByMobileUser('chats_lv2.sender', 'last_sender_from_role', $lv1GroupBy, $lv2WhereColMobileUserId, $mobileUser) . " , " .
                $this->getOneColumnFromSubqueryGetAllChatGroupedForMobileUserByMobileUser("chats_lv2.created_at", 'created_at', $lv1GroupBy, $lv2WhereColMobileUserId, $mobileUser) .
                " FROM chats 
                                    LEFT JOIN students students ON students.id = chats.student_id
                                    LEFT JOIN teachers teachers ON teachers.id = chats.teacher_id
                                    WHERE students.mobile_user_id = " . $mobileUser->id .
                " OR teachers.mobile_user_id = " . $mobileUser->id . " GROUP BY " . $lv1GroupBy
        );

        return $chats;
    }

    private function getOneColumnFromSubqueryGetAllChatGroupedForMobileUserByMobileUser($column, $alias, $lv1GroupBy, $lv2WhereColMobileUserId, $mobileUser)
    {
        return "(SELECT " . $column . " FROM chats AS chats_lv2 
                                    LEFT JOIN students AS students_lv2 ON students_lv2.id = chats_lv2.student_id
                                    LEFT JOIN teachers AS teachers_lv2 ON teachers_lv2.id = chats_lv2.teacher_id
                                    WHERE " . $lv2WhereColMobileUserId . " = " . $mobileUser->id .
            " AND " . ($mobileUser->role == "student" ? "chats_lv2.teacher_id" : "chats_lv2.student_id") . " = " . $lv1GroupBy .
            " ORDER BY chats_lv2.created_at DESC LIMIT 1) as " . $alias;
    }

    public function getChatGroupedByChatObjAndMobileUser($chatObj, $mobileUser)
    {
        if ($mobileUser->role == 'student') {
            $opponentStudentOrTeacherObj = $this->studentRepository->findStudentByMobileUserId($mobileUser->id);
        } else {
            $opponentStudentOrTeacherObj = $this->teacherRepository->findTeacherByMobileUserId($mobileUser->id);
        }

        return [
            'opponent_student_or_teacher_id' => $opponentStudentOrTeacherObj->id,
            'mobile_user_id' => $mobileUser->id,
            'name' => $opponentStudentOrTeacherObj->name,
            'profile_pict_url' => url('/storage/' . ($mobileUser->role == 'student' ? 'students' : 'teachers') . '/profile-pict/' . $opponentStudentOrTeacherObj->profile_pict),
            'role' => $mobileUser->role,
            'chat' => $chatObj->chat,
            'last_sender_from_role' => $chatObj->sender,
            'created_at' => json_decode(json_encode($chatObj->created_at)),
        ];
    }
}
