<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Helpers\AuthHelper;
use App\Helpers\FirebaseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\Chat\SendChatRequest;
use App\Http\Requests\Api\Mobile\Chat\GetChatByOponentIdRequest;
use App\Repositories\ChatsRepository;
use App\Repositories\MobileUserRepository;
use App\Repositories\StudentsRepository;
use App\Repositories\TeachersRepository;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    private $chatsRepository;
    private $studentRepository;
    private $teacherRepository;

    private $mobileUserRepository;

    public function __construct()
    {
        if (!$this->chatsRepository) {
            $this->chatsRepository = new ChatsRepository();
        }

        if (!$this->studentRepository) {
            $this->studentRepository = new StudentsRepository();
        }

        if (!$this->teacherRepository) {
            $this->teacherRepository = new TeachersRepository();
        }

        if (!$this->mobileUserRepository) {
            $this->mobileUserRepository = new MobileUserRepository();
        }
    }

    public function getChatByOponentId(GetChatByOponentIdRequest $request, $mobileUserOpponentId)
    {
        $mobileUser = AuthHelper::getCurrentAuthMobileUser();

        $chats = $this->chatsRepository->getChatByMobileUserAndMobileUserOpponentId($mobileUser, $mobileUserOpponentId, $request->page);

        return response()->json([
            'msg' => 'Chat Successfully Loaded',
            'data' => $chats
        ]);
    }

    public function sendChatToOpponentId(SendChatRequest $request, $opponentMobileUserId)
    {
        $mobileUser = AuthHelper::getCurrentAuthMobileUser();
        $opponentMobileUser = $this->mobileUserRepository->findById($opponentMobileUserId);

        $chat = $this->chatsRepository->sendChatFromMobileUserToOpponentMobileUserId($mobileUser, $opponentMobileUserId, $request);
        $chatGrouped = $this->chatsRepository->getChatGroupedByChatObjAndMobileUser($chat, $mobileUser);

        if ($mobileUser->role == 'student') {
            $userStudentOrTeacher = $this->studentRepository->findStudentByMobileUserId($mobileUser->id);
        } else {
            $userStudentOrTeacher = $this->teacherRepository->findTeacherByMobileUserId($mobileUser->id);
        }

        try {
            FirebaseHelper::sendNotification($userStudentOrTeacher->name, $chat->chat, $opponentMobileUser->fcm_token, $chatGrouped);
        } catch (\Throwable $th) {
            //throw $th;
        }

        return response()->json([
            'msg' => 'Chat Successfully Created',
            'data' => $chat
        ]);
    }

    public function getAllChatGroupedForMobileUser()
    {
        $mobileUser = AuthHelper::getCurrentAuthMobileUser();

        $chats = $this->chatsRepository->getAllChatGroupedForMobileUserByMobileUser($mobileUser);

        return response()->json([
            'code' => 200,
            'msg' => 'CHATS LOADED',
            'data' => $chats
        ], 200);
    }

    public function getChatByOponentIdAndAfterChatId($mobileUserOpponentId, $chatId)
    {
        $mobileUser = AuthHelper::getCurrentAuthMobileUser();

        $chats = $this->chatsRepository->getChatByMobileUserAndMobileUserOpponentIdAndAfterChatId($mobileUser, $mobileUserOpponentId, $chatId);

        return response()->json([
            'msg' => 'Chat Successfully Loaded',
            'data' => $chats
        ]);
    }
}
