<?php 
###################################################################################################
#                                                                                                 #
#                                                                                                 #
#                                  Kryptr Direct Messaging System                                 #
#                                                                                                 #
#                                                                                                 #
###################################################################################################
#Version: 0.0.0.0
#Last Updated 12:02pm(GTM) 20/08/2013(UK)
#Author: Rexzooly Kai Black
#Advisor: Shadow(Shadiku)

//Host Name, many hosts by default is set as localhost
define('K_Host', 'localhost');
//Database Name.
define('K_Name', '');
//Database Username.
define('K_User', '');
//Database Password.
define('K_Auth', '');
//API mode DB for Database mode, FF for Flat File Mode.
define('K_Mode', 'DB');
//API Return Mode JSON or HTML can be over ridden with &s=json, &s=html or $s=txt, if you set a invalied s it will default to html
$K_Return = 'html';
//Here we define the apicall pool
$CallPool = array(
	//The API Call List
	'call' => array('ip', 'username', 'login', 'myip'),
	//The API Style List
	'mode'=>array('json', 'j', 'html', 'h', 'txt', 'text', 't')
);

//Check Style/Mode
if(isset($_REQUEST['s'])){
	if(in_array(strtolower($_REQUEST['s']), $CallPool['mode'])){
		$K_Return = strtolower($_REQUEST['s']);
	}
}
//Check is the apicall was made
if(!isset($_REQUEST['apicall'])){
	echo '<strong>API Request:</strong><br />&nbsp;&nbsp;&nbsp;&nbsp;None/Missing<br /><strong>Server:</strong><br />&nbsp;&nbsp;&nbsp;&nbsp;We are sorry the action you have requested is not loged in out system please check your connection string and data requests and try again.';
}else{
	if(!in_array($_REQUEST['apicall'], $CallPool['call'])){
		echo '<strong>API Request:</strong><br />&nbsp;&nbsp;&nbsp;&nbsp;' . $_REQUEST['apicall'] . '<br /><strong>Server:</strong><br />&nbsp;&nbsp;&nbsp;&nbsp;We are sorry the action you have requested is not loged in out system please check your connection string and data requests and try again.';
	}else{
		//This Option is just for tested and for another project I am working on, I will leave it in for testing.
		if($_REQUEST['apicall'] == 'myip'){
			echo ReturnPrint($K_Return, (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : getenv('REMOTE_ADDR'));
		}
	}
}

//Placeholder functions for later use.
function ReturnPrint($Mode='html', $e_msg='', $pass='0'){
	//Return as Text (text, t, txt)
	if($Mode == 'txt' || $Mode == 'text' || $Mode == 't'){
		return 'pass:'.$pass.',return:'.$e_msg;
	}
	//Return As Json (json, j)
	if($Mode == 'json' || $Mode == 'j'){
		return json_encode(array('pass'=>$pass,'return'=>$e_msg));
	}
	//Return As HTML (html, h)
	if($Mode == 'html'|| $Mode == 'h'){
		if($pass == '0'){
			$PassWrd = 'Requessed Passed';
		}else{
			$PassWrd = 'Requessed Failed';
		}
		include 'html/header.php';
		echo '<div class="row-fluid">
			<h4>' . $PassWrd . '</h4>
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				' . $e_msg . '
			</div>
		</div>';
		include 'html/footer.php';
	}
}
?>