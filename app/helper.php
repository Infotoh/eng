<?php

//send firebase message
if (!function_exists('fcmTopic')) {
    function fcmTopic($topic, $title, $body)
    {
        fcm()
            ->to($topic)
            ->data([
                "click_action" => "FLUTTER_NOTIFICATION_CLICK",
            ])
            ->priority('normal')
            ->timeToLive(0)
            ->notification([
                'title' => $title,
                'body' => $body,
            ])->send();
    }
}

?>
