<?php
    session_start();
    $host='localhost';
    $dbName='madb';
    $dbUser='root';
    $dbPwd='root';
    try{
      $bdd = new PDO('mysql:host='.$host.';dbname='.$dbName.';charset=utf8', $dbUser, $dbPwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }catch (Exception $e){
      die('Erreur : ' . $e->getMessage());
    }