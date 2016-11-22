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

$notification["title"] ="Test";
$notification["body"] ="message";
$notification["sound"] ="default";
$notification["click_action"]="FCM_PLUGIN_ACTIVITY";
$notification["icon"]="fcm_push_icon";
$data = array('message'=>'Message','pdfurl'=>'http://103.249.204.101:7125/Slims_Demo/pdffiles/01001221-2016-11-18.pdf');



$fields['data'] = $data;
$fields['notification']=$notification;

$target =  array("cSAXxEDNCSs:APA91bFAWir7eJdLev2VtjEO3BZPAU-vtN16vHGfB4ZNfmV7r4Xff2_59aKulIvXGUtzoxzt1EBYEzkUW6xGJI2sDrxAvjjIQHWYgk742VWDW4EtkIMBlDdaUu0gEQkxwo9chxGcm_e7","dCfbnIemtyU:APA91bE0YlKYoNPMyB0rEIFztW9b8sUqeQYawqh3lOF1VeYqsPbfXcV9Kzc6gI7QuweUgQIC7ztmRHpAqi_tz7DvShhK6vGfMrgnL_LCnVcrTe7GPZqsFL8UaeZR7SQsp_Ras6HmhtxM");
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
