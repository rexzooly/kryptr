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
define('K_Return', 'html');
//Here we define the apicall pool
$CallPool = array('call' => array('ip', 'username', 'login', 'myip'), 'mode'=>array('json','html','txt'));

//Chec Style/Mode
if(!isset($_REQUEST['s'])){
	if(in_array($_REQUEST['s'], $CallPool['mode'])){
		define('K_Return', $_REQUEST['s']);
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
			echo ReturnPrint(K_Return, (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : getenv('REMOTE_ADDR'));
		}
	}
}
//Placeholder functions for later use.
function ReturnPrint($Mode='html', $e_msg='', $pass='0'){
	if($Mode == 'html'){
		return '';
	}
	if($Mode == 'json'){
		return json_encode(array('pass'=>$pass,'return'=>$e_msg));
	}
	if($Mode == 'text'){
		return '';
	}
}
?>