<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Helpers\AuthHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\Chat\GetChatByStudentIdAndTeacherIdRequest;
use App\Http\Requests\Api\Mobile\Chat\SendChatRequest;
use App\Repositories\ChatsRepository;
use App\Repositories\StudentsRepository;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    private $chatsRepository;
    private $studentRepository;

    public function __construct()
    {
        if (!$this->chatsRepository) {
            $this->chatsRepository = new ChatsRepository();
        }

        if (!$this->studentRepository) {
            $this->studentRepository = new StudentsRepository();
        }
    }

    public function getChatByStudentIdAndTeacherId(GetChatByStudentIdAndTeacherIdRequest $request)
    {
        $mobileUser = AuthHelper::getCurrentAuthMobileUser();
        $studentObj = $this->studentRepository->findStudentByMobileUserId($mobileUser->id);

        $chats = $this->chatsRepository->getChatByStudentIdAndTeacherId($studentObj->id, $request->teacher_id);

        return response()->json([
            'msg' => 'Chat Successfully Loaded',
            'data' => $chats
        ]);
    }

    public function sendChat(SendChatRequest $request)
    {
        $mobileUser = AuthHelper::getCurrentAuthMobileUser();
        $student = $this->studentRepository->findStudentByMobileUserId($mobileUser->id);

        $chat = $this->chatsRepository->studentObjCreateChat($student, $request);

        return response()->json([
            'msg' => 'Chat Successfully Created',
            'data' => $chat
        ]);
    }
}
