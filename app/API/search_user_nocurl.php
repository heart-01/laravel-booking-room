<?php
$username = '';
$access_token = '';

$api_url = 'https://api.account.kmutnb.ac.th/api/account-api/user-info';
$params = array('username' => $username);
$header[] = 'Content-type: application/x-www-form-urlencoded';
$header[] = 'Authorization: Bearer ' . $access_token;
$options = array(
	'http'=> array(
		'header'  => $header,			
		'method'  => 'POST',
		'content' => http_build_query($params),
		'timeout' => 10,  // Seconds
	),
	'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,			
	),
);

$context = stream_context_create($options);
$result  = @file_get_contents($api_url, false, $context);

if($result === false){
	$error = error_get_last();
	$error = explode(': ', $error['message']);
	echo 'Error: '. trim($error[2]);
}else{
    $json_data = json_decode($result, true);
	if(!isset($json_data['api_status'])){
		echo 'API Error ' . print_r($result, true);
	}elseif($json_data['api_status'] == 'fail'){
		echo "API Error: " . $json_data['api_status_code'] . ' - ' . $json_data['api_message'];
	}elseif($json_data['api_status'] == 'success'){
		$user = $json_data['userInfo'];
		echo '<b>User information from ICIT ACCOUNT</b>';
		echo '<hr />';		
		echo 'Username: ' . $user['username'];
		echo '<br />Name: ' . $user['displayname'];	
		echo '<br />First name: ' . $user['firstname_en'];
		echo '<br />Last name: ' . $user['lastname_en'];	
		echo '<br />Email: ' . $user['email'];
		echo '<br />Account type: ' . $user['account_type'];
	}else{
		echo "Internal Error";
	}
}
?>