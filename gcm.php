<?php

// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AIzaSyDGM0hPh6v3auyAwLJmKAO8NSqUf30uvLk' );


$registrationIds = array("111APA91bHpy-_d_eJ1hZmalBc67-BuAAM79FoMkjxRO_UF33RA5PSNRAQfj-D7TEg26pX42sgFpPXVQjk_WkfQlqXoIt_Vwj9SA7n8zaAfUqHdop0CeGcAwvseBJdquTXb_bqjAZPZ1RL6dDkKecm_mqjwnuWTxCbbgA" );

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
