<?php

$requestedPage=$_SERVER["REDIRECT_URL"];
$router=str_replace('/CSRF-Attack/','',$requestedPage);
if($router == ''){
    include 'index.php';
    exit;
}else if($router == 'login'){
    include 'login.php';
    exit;
}else if($router == 'logout'){
    include 'logout.php';
    exit;
}else if($router=='register'){
    include 'register.php';
    exit;
}else if($router=='change/password'){
    include 'changePassword.php';
    exit;
}else{
    include '404.php';
    exit;
}