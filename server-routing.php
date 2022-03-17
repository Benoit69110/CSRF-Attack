<?php

$requestedPage=$_SERVER["REDIRECT_URL"];
$router=str_replace('/CSRF-Attack/','',$requestedPage);

if($router[-1]=='/'){
    $router=substr($router, 0, -1);
}

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
}else if($router=='change/password' || $router=='change/password/level1'){
    $_POST['level']=1;
    include 'changePassword.php';
    exit;
}else if($router=='change/password/level2'){
    $_POST['level']=2;
    include 'changePassword.php';
    exit;
}else{
    echo "error 404";
    include '404.php';
    exit;
}