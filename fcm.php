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
$server_key = 'AIzaSyDLjgLQLon7be9Z3Hhqehuop_nM5EBT5tw';
$fields = array();

$notification["title"] ="Test";
$notification["body"] ="message";
$notification["sound"] ="default";
$notification["click_action"]="FCM_PLUGIN_ACTIVITY";
$notification["icon"]="fcm_push_icon";
$data = array('message'=>'Message','pdfurl'=>'http://59.93.41.160/slims/pdffiles/01007468-2016-09-30.pdf');



$fields['data'] = $data;
$fields['notification']=$notification;

$target =  array("clqky1qOaXo:APA91bH94u34kOIz_1gkRMBS_9wFSLOxUIaEFXXT13kg3v0t2y5CtlPUvdH1qaMkfaaUrLF8XZIyJQXcOTa5v5R5vIOKXj-UhYk4EwE3GPAaFSFTYRF17wAHIZpHQJS1vj5bi_KPq84S","dCfbnIemtyU:APA91bE0YlKYoNPMyB0rEIFztW9b8sUqeQYawqh3lOF1VeYqsPbfXcV9Kzc6gI7QuweUgQIC7ztmRHpAqi_tz7DvShhK6vGfMrgnL_LCnVcrTe7GPZqsFL8UaeZR7SQsp_Ras6HmhtxM");
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
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result = curl_exec($ch);
if ($result === FALSE) {
	die('FCM Send Error: ' . curl_error($ch));
}
curl_close($ch);
echo $result;
