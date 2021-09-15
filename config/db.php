<?php
//include_once '../library/mFunctions.php';
$locdb = "127.0.0.1";
$namedb = "shop";
$userdb = "root";
$passdb = ""; //если указан

$dbcon = mysqli_connect($locdb, $userdb, $passdb, $namedb);
//simpledebug($dbcon);
if (!$dbcon){
    echo "Error access from MySql";
    exit();
}

mysqli_set_charset($dbcon,'utf8mb4');

if(!mysqli_select_db($dbcon, $namedb)){
    echo "Error access from DB: {$namedb}"; 
    exit();
}


