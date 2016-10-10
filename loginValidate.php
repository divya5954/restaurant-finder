<?php

$link = mysqli_connect("localhost", "root", "","restro");
if (mysqli_connect_error()){
    die('Unable to connect to the database');
}
$error=""; 

if (!$_POST['email']){
    $error = 'One or more fields are empty';
}
if (!$_POST['password']){
    $error = 'One or more fields are empty';
}
if ($error == ""){
    //login
    // if no errors , then set to success
    
}

echo $error;

?>