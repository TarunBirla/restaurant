<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseNotificationService
{
    protected $messaging;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(
                storage_path(
                    'app/firebase/firebase.json'
                )
            );

        $this->messaging =
            $factory->createMessaging();
    }

    public function send(
        $token,
        $title,
        $body
    ) {

        try {

            $message =
                CloudMessage::withTarget(

                    'token',
                    $token

                )->withNotification(

                    Notification::create(

                        $title,
                        $body
                    )
                );

            $this->messaging
                ->send($message);

        } catch (\Exception $e) {

            \Log::error(
                'FCM ERROR: '
                . $e->getMessage()
            );
        }
    }
}