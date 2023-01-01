<?php

//send firebase message
if (!function_exists('fcmTopic')) {
    function fcmTopic($topic, $title, $body)
    {
        return fcm()
            ->to($topic)
            ->data([
                "click_action" => "FLUTTER_NOTIFICATION_CLICK",
            ])
            ->priority('normal')
            ->enableResponseLog()
            ->timeToLive(0)
            ->notification([
                'title' => $title,
            ])->send();
    }
}

?>
