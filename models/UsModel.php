<?php


function NewUsrReg($mail, $passhash, $fio, $tel, $adr){
    global $dbcon;
    $mail = htmlspecialchars(mysqli_real_escape_string($dbcon, $mail)); //чек на сайте php, нужна для безопасности
    
    $passhash = htmlspecialchars(mysqli_real_escape_string($dbcon, $passhash)); //чек на сайте php, нужна для безопасности
    $fio = htmlspecialchars(mysqli_real_escape_string($dbcon, $fio)); //чек на сайте php, нужна для безопасности
    $tel = htmlspecialchars(mysqli_real_escape_string($dbcon, $tel)); //чек на сайте php, нужна для безопасности
    $adr = htmlspecialchars(mysqli_real_escape_string($dbcon, $adr)); //чек на сайте php, нужна для безопасности
    
    $sqlcom = "INSERT INTO users (`mail`,`pass`,`fio`,`telephone`,`adr`) values ('{$mail}','{$passhash}','{$fio}','{$tel}','{$adr}')"; //тут надо сомтреть на phpmyadmin, переходить на вкладку SQL и жать на INSERT И смотреть ситнтаксис
    
    $dataset = mysqli_query($dbcon, $sqlcom);
    
    
    if ($dataset) {
        $sqlcom = "SELECT * from users where (`mail` = '{$mail}' and `pass` = '{$passhash}') limit 1";  //проверка на созданного пользователя
        $dataset = mysqli_query($dbcon, $sqlcom);
        $dataset = createSmartyDsArr($dataset);
        
        if(isset($dataset[0])){
            $dataset['success']=1; //тут мы добавлляем поле success и вносим в него данные
        }
        else{
            $dataset['success']=0;
        }
        
    }
    else {
        $dataset['success'] = 0;
    }
    return $dataset;
            
}

function RegParCheck($mail, $pass1, $pass2){
    $result = null;
    
    if(! $mail){
        $result['success'] = false;
        $result['mesg'] = 'Внесите почту';
    }
    
     if(! $pass1){
        $result['success'] = false;
        $result['mesg'] = 'Внесите пароль';
    }
    
     if(! $pass2){
        $result['success'] = false;
        $result['mesg'] = 'Повторите пароль';
    }
    
     if($pass1 != $pass2){
        $result['success'] = false;
        $result['mesg'] = 'Введенные пароли не совпадают';
    }
    
    return $result;
} 
function checkMail($mail){
        global $dbcon;
        $mail = mysqli_real_escape_string($dbcon, $mail);
        $sqlcom = "SELECT id from users where mail = '{$mail}'";
        
        $checkresult = mysqli_query($dbcon, $sqlcom);
        $checkresult = createSmartyDsArr($checkresult);
        
        return $checkresult;
    }
    
    function logUsr($mail, $pass){
        
        global $dbcon;
        $mail = htmlspecialchars(mysqli_real_escape_string($dbcon, $mail));
        $pass = md5($pass);
        
        $sqlcom = "select * from users where (`mail` = '{$mail}' and `pass` = '{$pass}') limit 1";
        
        $dataset = mysqli_query($dbcon, $sqlcom);
       // simpledebug($dataset);
        
        $dataset = createSmartyDsArr($dataset);
        
        if(isset($dataset[0])){
            $dataset['success'] = 1;
        }
        else{
            $dataset['success'] = 0;
        }
            // simpledebug($dataset);
        return $dataset;
    }
    
    function updUsr($fio, $tel, $adr, $pass1, $pass2, $crntPass){
        global $dbcon;
    $mail = htmlspecialchars(mysqli_real_escape_string($dbcon, $_SESSION['usr']['mail'])); //чек на сайте php, нужна для безопасности
    $fio = htmlspecialchars(mysqli_real_escape_string($dbcon, $fio)); //чек на сайте php, нужна для безопасности
    $tel = htmlspecialchars(mysqli_real_escape_string($dbcon, $tel)); //чек на сайте php, нужна для безопасности
    $adr = htmlspecialchars(mysqli_real_escape_string($dbcon, $adr)); //чек на сайте php, нужна для безопасности
    $pass1 = trim($pass1);
    $pass2 = trim($pass2);
    //simpledebug($adr);
    $nPass = null;
    if ($pass1 && ($pass1 == $pass2)){
        $nPass = md5($pass1);
    }
    
    $sqlcom = "UPDATE users set ";
    
    if ($nPass){
        $sqlcom .="`pass` = '{$nPass}', ";
    }
    
    $sqlcom .= "`fio` = '{$fio}',
             `telephone` = '{$tel}',
             `adr` = '{$adr}'
              where
              `mail` = '{$mail}' and `pass` = '{$crntPass}'
              limit 1";    
    $dataset = mysqli_query($dbcon, $sqlcom);
    
    return $dataset;
    
    }
    
    function getUsrOrds(){
        $usrId = isset($_SESSION['usr']['id']) ? $_SESSION['usr']['id'] : 0;
        $dataset = getOrdsWithProdsUsr($usrId);
        
        return $dataset;
    }

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

