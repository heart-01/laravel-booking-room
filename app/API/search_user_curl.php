<?php
$access_token = ''; // <----- API - Access Token Here
$username 	= ''; // <----- Username for search

$api_url = 'https://api.account.kmutnb.ac.th/api/account-api/user-info'; // <----- API URL

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('username' => $username));

if(($response = curl_exec($ch)) === false){
	echo 'Curl error: ' . curl_errno($ch) . ' - ' . curl_error($ch);
}else{
	$json_data = json_decode($response, true);
	if(!isset($json_data['api_status'])){
		echo 'API Error ' . print_r($response, true);
	}elseif($json_data['api_status'] == 'success'){
		echo 'Account found';
		echo "<br />=============================";
		echo "<br />Username: " . $json_data['userInfo']['username'];
		echo "<br />Displayname: " . $json_data['userInfo']['displayname'];
		echo "<br />Firstname EN: " . $json_data['userInfo']['firstname_en'];
		echo "<br />Lastname EN: " . $json_data['userInfo']['lastname_en'];
		echo "<br />Email: " . $json_data['userInfo']['email'];
		echo "<br />Account type: " . $json_data['userInfo']['account_type'];
	}elseif($json_data['api_status'] == 'fail'){
		echo "API Error: " . $json_data['api_status_code'] . ' - ' . $json_data['api_message'];
	}else{
		echo "Internal Error";
	}	
}
curl_close($ch);
?>