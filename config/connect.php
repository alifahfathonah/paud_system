<?php
/*
 * File connection with mysqli
 */ 

$host = 'localhost';
$user = 'root';
$password = 'sukses45';
$db = 'paud_system';

$mysqli = mysqli_connect($host, $user, $password, $db);

if(mysqli_connect_errno()){
    echo ' Failed to connect Mysql ' .  mysqli_connect_errno();
}else{
    echo '';
}



