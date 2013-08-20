<?php 
###################################################################################################
#                                                                                                 #
#                                                                                                 #
#                                  Kryptr Direct Messaging System                                 #
#                                                                                                 #
#                                                                                                 #
###################################################################################################
#Version: 0.0.0.0
#Last Updated 18:40pm(GTM) 20/08/2013(UK)
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
define('K_Mode', 'FF');
//API Return Mode JSON or HTML can be over ridden with &s=json, &s=html or $s=txt, if you set a invalied s it will default to html
$K_Return = 'html';
//Here we define the apicall pool
$CallPool = array(
	//The API Call List
	'call' => array('ip', 'check', 'login', 'myip'),
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
	echo ReturnPrint($K_Return, 'We are sorry the action you have requested is not loged in out system please check your connection string and data requests and try again.', '1');
}else{
	if(!in_array($_REQUEST['apicall'], $CallPool['call'])){
		echo ReturnPrint($K_Return, 'We are sorry the action you have requested is not loged in out system please check your connection string and data requests and try again.', '1');
	}else{
		//This Option is just for tested and for another project I am working on, I will leave it in for testing.
		if($_REQUEST['apicall'] == 'myip'){
			echo ReturnPrint($K_Return, (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : getenv('REMOTE_ADDR'));
		}
		if($_REQUEST['apicall'] == 'check'){
			if(isset($_REQUEST['user'])){
				if(checkuser($_REQUEST['user'])){
					ReturnPrint($K_Return, strtolower($_REQUEST['user']).' was found.');
				}else{
					ReturnPrint($K_Return, 'We was unable to find '.strtolower($_REQUEST['user']).' in our database', '1');
				}
			}else{
				echo ReturnPrint($K_Return, 'We are sorry the action you have requested is not loged in out system please check your connection string and data requests and try again.', '1');
			}
		}
	}
}

//Placeholder functions for later use.
function ReturnPrint($Mode='html', $e_msg='', $pass='0'){
	//Return as Text (text, t, txt)
	if($Mode == 'txt' || $Mode == 'text' || $Mode == 't'){
		header("Content-Type: text/plain");
		die('pass:'.$pass.',return:'.$e_msg);
	}
	//Return As Json (json, j)
	if($Mode == 'json' || $Mode == 'j'){
		header('Content-type: application/json');
		die(json_encode(array('pass'=>$pass,'return'=>$e_msg)));
	}
	//Return As HTML (html, h)
	if($Mode == 'html'|| $Mode == 'h'){
		if($pass == '0'){
			$PassWrd = 'Requessed Passed';
			$info = 'alert-info';
		}else{
			$PassWrd = 'Requessed Failed';
			$info = 'alert-error';
		}
		header('Content-Type: text/html; charset=utf-8');
		include 'html/header.php';
		echo '<div class="row-fluid">
			<h4>' . $PassWrd . '</h4>
			<div class="alert ' . $info . '">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				' . $e_msg . '
			</div>
		</div>';
		include 'html/footer.php';
		return;
	}
}
function checkuser($k_name){
	if(K_Mode == 'DB'){
		
	}
	if(K_Mode == 'FF'){
		if(file_exists('data/'.strtolower($_REQUEST['user']))){
			return true;
		}else{
			return false;
		}
	}
}

//PDO Connection
function kPDOon(){

}
function kPDOoff(){

}
?>