<?php
/*  
Parameter Example
	$data = array('post_id'=>'12345','post_title'=>'A Blog post');
	$target = 'single tocken id or topic name';
	or
	$target = array('token1','token2','...'); // up to 1000 in one request
*/

//FCM api URL
$url = 'https://fcm.googleapis.com/fcm/send';
//api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
$server_key = 'AIzaSyBWNop1S48dmcnsLOJS4XQkpls3K4c9nfE';
$fields = array();

$notification["title"] ="";
$notification["body"] ="sds";
$notification["sound"] ="default";
$notification["click_action"]="FCM_PLUGIN_ACTIVITY";
$notification["icon"]="fcm_push_icon";
$fields['notification']=$notification;// push notification default data part - for title,short description etc

$data = array('pdfurl'=>'http://www.pdfpdf.com/samples/Sample2.PDF');
$fields['data'] = $data;//custom data part - for custom messages

$target =  array("eAo379WR6-Q:APA91bE8VYU4gQTRQLCqB7_ovempqmPfzBSfrINnvaU5gsBTjW6jdKc_OtYtaQ9wLAHw8HvTjYj3twy7q0fAb7sfRI_WLCn9aAsMjuPoTz0pr5ezchtKrdGlWicrFr0UlBw7Y2UwfsHq","ex2g-6qIzJg:APA91bHKXlENhRDbSSKwT7ikOGaPN_tVV5_8w0SaH2ep3lfKMerbzMnsS4gJ4yJgIvWchDrzYKltLorAUKwA2AU1l05VxkUvETPGipBRUl8FGyzemmeZLfBTywwAlZFnOforJO4Awjx9");// Phone push token
if(is_array($target)){
	$fields['registration_ids'] = $target;
}else{
	$fields['to'] = $target;
}
//header with content_type api key
$headers = array(
	'Content-Type:application/json',
  'Authorization:key='.$server_key
);
			
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));// push data and receiver phone tokens
$result = curl_exec($ch);
if ($result === FALSE) {
	die('FCM Send Error: ' . curl_error($ch));
}
curl_close($ch);

echo "<br> Input data";
echo "<br>". json_encode($fields);//data
echo "<br>". $result;//output

