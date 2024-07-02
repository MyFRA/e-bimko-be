<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Helpers\AuthHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\Chat\GetChatByStudentIdAndTeacherIdRequest;
use App\Http\Requests\Api\Mobile\Chat\SendChatRequest;
use App\Repositories\ChatsRepository;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    private $chatsRepository;

    public function __construct()
    {
        if (!$this->chatsRepository) {
            $this->chatsRepository = new ChatsRepository();
        }
    }

    public function getChatByStudentIdAndTeacherId(GetChatByStudentIdAndTeacherIdRequest $request)
    {
        $chats = $this->chatsRepository->getChatByStudentIdAndTeacherId(AuthHelper::getCurrentAuthStudent()->id, $request->teacher_id);

        return response()->json([
            'msg' => 'Chat Successfully Loaded',
            'data' => $chats
        ]);
    }

    public function sendChat(SendChatRequest $request)
    {
        $student = AuthHelper::getCurrentAuthStudent();

        $chat = $this->chatsRepository->studentObjCreateChat($student, $request);

        return response()->json([
            'msg' => 'Chat Successfully Created',
            'data' => $chat
        ]);
    }
}
