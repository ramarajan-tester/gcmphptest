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
$server_key = 'AIzaSyDh3rR2iJpuodX45ezaDCw3_2tsC5XWhkE';
$fields = array();

$notification["title"] ="Test";
$notification["body"] ="message";
$notification["sound"] ="default";
$notification["click_action"]="FCM_PLUGIN_ACTIVITY";
$notification["icon"]="fcm_push_icon";
$data = array('message'=>'Message','pdfurl'=>'http://103.249.204.101:7125/Slims_Demo/pdffiles/01001221-2016-11-18.pdf');



$fields['data'] = $data;
$fields['notification']=$notification;

$target =  array("ddtN-pYhih8:APA91bGCZsbbRqLzc6Cv7RDKqE1i0QH_XbU258blDF8ObCqJBa3D2CfdcE0_RFnVeY-e2anQDIOdrJKmCSXGyjBS4WDAr2AJz98rX9B3bHVgwq8ul8yDWc1e5fUJfSfrk00hPAdqPOyL","dCfbnIemtyU:APA91bE0YlKYoNPMyB0rEIFztW9b8sUqeQYawqh3lOF1VeYqsPbfXcV9Kzc6gI7QuweUgQIC7ztmRHpAqi_tz7DvShhK6vGfMrgnL_LCnVcrTe7GPZqsFL8UaeZR7SQsp_Ras6HmhtxM");
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
