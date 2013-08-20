<?php
###################################################################################################
#                                                                                                 #
#                                                                                                 #
#                            Kryptr Direct Messaging System  Config                               #
#                                                                                                 #
#                                                                                                 #
###################################################################################################
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
	if(K_Mode == 'DB-i'){
		
	}
	if(K_Mode == 'DB-PDO'){
		
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