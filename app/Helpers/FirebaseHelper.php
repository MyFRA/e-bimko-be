<?php

namespace App\Helpers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseHelper
{
    public static function sendNotification($title, $message, $token, $payload = [])
    {
        // 2. Configure Firebase
        $factory = (new Factory)->withServiceAccount(storage_path('app/e-bimko-firebase-adminsdk-vog9n-ba31628aea.json'));
        $messaging = $factory->createMessaging();
        $message = CloudMessage::withTarget('token', $token)
            ->withNotification(Notification::create($title, $message))
            ->withData($payload);

        try {
            $messaging->send($message);
            return response()->json(['message' => 'Notification sent successfully'], 200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['error' => 'Failed to send notification: ' . $e->getMessage()], 500);
        }
    }
}
