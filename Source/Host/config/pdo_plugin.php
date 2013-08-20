<?php
###################################################################################################
#                                                                                                 #
#                                                                                                 #
#                                     Kryptr PDO Plugin                                           #
#                                                                                                 #
#                                                                                                 #
###################################################################################################
function kPDOon(){
	$Connection = new PDO("mysql:host=" . K_Host . ";dbname=" . K_Name . ";", K_User, K_Auth);
	$Connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $Connection;
}
function kPDOoff(){
	$Connection = null;
	return $Connection;
}
function usercheck($k_name){
	$Connection = kPDOon();
	$sql = $Connection->prepare('SELECT * FROM kryptr WHERE user=:nid');
	$sql->execute(array('nid' => $k_name));
	$result = $sql->fetch();
	if(count($result) == 0 || $result == ''){
		return false;
	}else{
		return true;
	}
	$Connection = kPDOoff();
}
?>