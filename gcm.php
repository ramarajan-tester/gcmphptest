<?php

// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AIzaSyCAf5jJ7thpOKFGEo2rkYG-gJnv9hlA25Q' );


$registrationIds = array("dUPLt84BL6Q:APA91bGlxxfmHXnw_deZK_17cvYetIGpUTmtH9AZ_iPl6QA-TRu3sSC8KO1LxeXjw56vht09cgvqjVxttHvv0JPmZ2QDmrMCMur0WyGGlyoWtrtH5mQC1HNmbaZDcz2KEcdiy67vU9Y4");

// prep the bundle
$msg = array
(
    'message'       => 'here is a message. message',
    'title'         => 'This is a title. title',
    'subtitle'      => 'This is a subtitle. subtitle',
    'tickerText'    => 'Ticker text here...Ticker text here...Ticker text here',
    'vibrate'   => 1,
    'sound'     => 1
);

$fields = array
(
    'registration_ids'  => $registrationIds,
    'data'              => $msg
);

$headers = array
(
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type: application/json'
);

$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );

echo $result;
?>
