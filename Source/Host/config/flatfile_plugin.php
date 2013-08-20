<?php

function usercheck($f_name){
	if(file_exists('data/'.strtolower($f_name))){
		return true;
	}else{
		return false;
	}
}
?>