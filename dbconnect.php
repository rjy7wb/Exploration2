<?php

$server 	= 'localhost';
$username 	= 'ubuntu';
$password 	= 'password';
$database 	= 'exploration2';

if(!$link = (mysqli_connect($server,$username,$password,$database))){
	die('oops connection problem ! --> ' . mysqli_error($link));
}
?>

