<?php

$link = mysqli_connect("localhost", "root", "","restro");
if (mysqli_connect_error()){
    die('Unable to connect to the database');
}
$error=""; 

if (strlen($_POST['password'])<8){
    $error = 'Password must have atleast 8 characters';
}
if (!$_POST['password']){
    $error = 'Please enter password';
}
if (!$_POST['email']){
    $error = 'Please enter a valid email id';
}
if (!$_POST['username']){
    $error = 'Enter username';
}

if ($error == ""){
    //signup
    // if no errors , then set to success
    $error = 'success';
    
}

echo $error;

?>