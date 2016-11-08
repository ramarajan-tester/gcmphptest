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

$notification["title"] ="Title";
$notification["body"] ="message";
$notification["sound"] ="default";
$notification["click_action"]="FCM_PLUGIN_ACTIVITY";
$notification["icon"]="fcm_push_icon";
$data = array('notification'=>$notification,'pdfurl'=>'www.google.com');

$fields['data'] = $data;
$target =  array("dUPLt84BL6Q:APA91bGlxxfmHXnw_deZK_17cvYetIGpUTmtH9AZ_iPl6QA-TRu3sSC8KO1LxeXjw56vht09cgvqjVxttHvv0JPmZ2QDmrMCMur0WyGGlyoWtrtH5mQC1HNmbaZDcz2KEcdiy67vU9Y4");
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
