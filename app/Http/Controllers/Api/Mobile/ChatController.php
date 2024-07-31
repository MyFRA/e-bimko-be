<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Helpers\AuthHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\Chat\SendChatRequest;
use App\Http\Requests\Api\Mobile\Chat\GetChatByOponentIdRequest;
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

    public function getChatByOponentId($mobileUserOpponentId)
    {
        $mobileUser = AuthHelper::getCurrentAuthMobileUser();

        $chats = $this->chatsRepository->getChatByMobileUserAndMobileUserOpponentId($mobileUser, $mobileUserOpponentId);

        return response()->json([
            'msg' => 'Chat Successfully Loaded',
            'data' => $chats
        ]);
    }

    public function sendChatToOpponentId(SendChatRequest $request, $opponentMobileUserId)
    {
        $mobileUser = AuthHelper::getCurrentAuthMobileUser();

        $chat = $this->chatsRepository->sendChatFromMobileUserToOpponentMobileUserId($mobileUser, $opponentMobileUserId, $request);

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
}
