<?php
$user = array(
	'name'=>'user',
	'ip'=>'192.168.0.1',
	'auth'=>'696d29e0940a4957748fe3fc9efd22a3'
);

file_put_contents($user['name'],serialize($user));
?>