<?php
namespace  App\Notifications;


use App\Models\User;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class  Push {

    public static function PushKitToken(){

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://oauth-login.cloud.huawei.com/oauth2/v3/token');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded' ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "grant_type=client_credentials&client_id=105971119&client_secret=252b3afbbe95d85e920cb88fb0f83a996249d01f2824b51a4943ac239a5f0983",
        );


        $response = curl_exec($ch);

        $res = json_decode($response , true);

        return $res;
    }

    public static function PushKit($tokenKit , $baerer , $title , $body , $type){


        $data = [ "type" => $type , 'title' => urldecode($title) , 'body' => urldecode($body)  ];
        $json = json_encode($data);

        $dataKIT =
            [
                "validate_only" => false,
                "message" => [
                    "data" => $json,
                    "token" => [
                        $tokenKit
                    ]
                ],

            ];

        $dataStringKIT = json_encode($dataKIT);

        $headersKIT = [
            'Authorization: Bearer '. $baerer,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://push-api.cloud.huawei.com/v1/105971119/messages:send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headersKIT);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataStringKIT);

        $response = curl_exec($ch);

        $res = json_decode($response , true);


//
//        }



        return $res;

    }

    public  static  function  PushFirbase($tokenFirebase , $title , $body , $type){


        $data =
            [
                "registration_ids" => $tokenFirebase,
                "notification" =>
                    [
                        "title" => $title,
                        "body" => $body,
                        "content_available" => true,
                        "priority" => "high",
                        "sound" => "default",
                        "type" => $type,
                    ],
                "data" => [
                    "title" => $title,
                    "body" => $body,
                    "content_available" => true,
                    "priority" => "high",
                    "sound" => "default",
                    "type" => $type,
                ],
            ];

        $dataString = json_encode($data);
//AAAAp9c1jW4:APA91bEusMqgE-cEyQe-770MzfOW2sWLZ0jGfuCEr28-k7oPev57s8QJHAE-4vUGQyPbwVQbiOk5bHslWVIJFpR17V0X-BsRRGkOGCwUYbB5Fz_ogr7vNq--59JhtjbqX4JAJx9EpzhQ
        $headers = [
            'Authorization: key=AAAAPn_qGMk:APA91bF3ApL1sQ3Luz519WqB4lVZZBKoJTRoJbsSVRxX069lYCmEQZs68pqph_3_nuLz8qrBf3CueRK0nwq4gHfwNw215iJSaxaEy-ibiOj_r8R5PyfbNZJJsi_iCiGO8mqt0tEkVhNV',
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
        $res = json_decode($response , true);

//        dd($res);


    }


    public static function sendToDevice($device_token, $title , $body,$device_type)
    {


        $firebase = (new Factory)
            ->withServiceAccount(base_path().'/config/skystoreez-firebase-adminsdk-u84l6-d0e3afa9b0.json');

        $messaging = $firebase->createMessaging();
        $data = [
            "title" => $title,
            "body" => $body,
            "content_available" => true,
            "priority" => "high",
            "sound" => "default",
            "type" => $device_type,
        ];

        // Prepare the notification array
        $notification = Notification::create($title, $body);

        // Create CloudMessage instance
        $message = CloudMessage::withTarget('token', $device_token)
            ->withNotification($notification)
            ->withData($data);

        try {
            // Send message
            $messaging->send($message);
            return response()->json([
                'message' => 'Notification has been sent'
            ]);
        } catch (\Exception $e) {
            // Handle exception
            return response()->json([
                'error' => 'Failed to send notification',
                'message' => $e->getMessage()
            ], 500);
        }
    }



    public static function sendPushNotification()
    {
        $firebase = (new Factory)
            ->withServiceAccount(__DIR__.'/../../config/kunzhua-2642d-firebase-adminsdk-t7nxt-50976815db.json');


        $messaging = $firebase->createMessaging();

        $message = CloudMessage::fromArray([
            'notification' => [
                'title' => 'Hello from Firebase!',
                'body' => 'This is a test notification.'
            ],
            'topic' => 'global'
        ]);

        $messaging->send($message);


    }



}
