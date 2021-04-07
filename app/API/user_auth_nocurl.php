<?php
	$access_token = '';
	$scopes = 'personel,student,templecturer'; 	// <----- Scopes for search account type
	$username = '';
	$password = '';
	
	$api_url = 'https://api.account.kmutnb.ac.th/api/account-api/user-authen'; // <----- API URL
	$post_data = array('scopes' => $scopes, 'username' => $username, 'password' => $password);
    $options = array(
        'http'=> array(
            'header'  => array(
                            'Content-type: application/x-www-form-urlencoded',
                            'Authorization: Bearer ' . $access_token,
                        ),				
            'method'  => 'POST',
            'content' => http_build_query($post_data),
            'timeout' => 10,  // Seconds
		),
	  	'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,			
		),
    );
    $context = stream_context_create($options);
    $response  = @file_get_contents($api_url, false, $context);	   
	$data = array();
    if($response === false){
        $error = error_get_last();
        $error = explode(': ', $error['message']);
        echo 'Error: '. trim($error[2]);
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
?>