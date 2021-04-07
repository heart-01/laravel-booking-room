<?php
$access_token = 'S670ZYehFLgE9q_hm_lkOdN2ZPW8BBwO'; // <----- API - Access Token Here
$scopes 	= 'personel,student,templecturer'; 	// <----- Scopes for search account type
$username 	= 's6202041520164'; // <----- Username for authen
$password 	= '77749000'; 	// <----- Password for authen

$api_url = 'https://api.account.kmutnb.ac.th/api/account-api/user-authen'; // <----- API URL

$ch = curl_init();// Initiate connection
curl_setopt($ch, CURLOPT_URL, $api_url); // set url
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // 10s timeout time for cURL connection
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Allow https verification if true
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Verify the certificate's name against host 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);// Set so curl_exec returns the result instead of outputting it.
curl_setopt($ch, CURLOPT_POST, true);// Set post method
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // automatically follow Location: headers (ie redirects)
curl_setopt($ch, CURLOPT_POSTFIELDS, array('scopes' => $scopes, 'username' => $username, 'password' => $password));

if(($response = curl_exec($ch)) === false){
	echo 'Curl error: ' . curl_errno($ch) . ' - ' . curl_error($ch);
}else{

	$json_data = json_decode($response, true);
	if(!isset($json_data['api_status'])){
		echo 'API Error ' . print_r($response, true);
	}elseif($json_data['api_status'] == 'success'){
		echo 'Login success';
		echo "<br />=============================";
		echo "<br />Username: " . $json_data['userInfo']['username'];
		echo "<br />Displayname: " . $json_data['userInfo']['displayname'];
		echo "<br />Firstname EN: " . $json_data['userInfo']['firstname_en'];
		echo "<br />Lirstname EN: " . $json_data['userInfo']['lastname_en'];
		echo "<br />pid: " . $json_data['userInfo']['pid'];
		echo "<br />Email: " . $json_data['userInfo']['email'];
		echo "<br />Birthdate: " . $json_data['userInfo']['birthdate'];
		echo "<br />Account type: " . $json_data['userInfo']['account_type'];
	}elseif($json_data['api_status'] == 'fail'){
		echo "API Error: " . $json_data['api_status_code'] . ' - ' . $json_data['api_message'];
	}else{
		echo "Internal Error";
	}
}
curl_close($ch);
?>