<?php
include_once '../models/CatsModel.php';
//include_once '../models/OrdModel.php';
include_once '../models/UsModel.php';
include_once '../models/OrdModel.php';
include_once '../models/PurModel.php';

function regAction(){ // к этой функции обратимся из m.js
    $mail = isset($_REQUEST['mail']) ? $_REQUEST['mail'] : null;
    $mail = trim($mail);
    
    $pass1 = isset($_REQUEST['pass1']) ? $_REQUEST['pass1'] : null;
    $pass2 = isset($_REQUEST['pass2']) ? $_REQUEST['pass2'] : null;

    $telephone = isset($_REQUEST['telephone']) ? $_REQUEST['telephone'] : null;
    $adr = isset($_REQUEST['adr']) ? $_REQUEST['adr'] : null;
    $fio = isset($_REQUEST['fio']) ? $_REQUEST['fio'] : null;
    $fio = trim($fio);
    
    $resultData = null;
    $resultData = RegParCheck($mail, $pass1, $pass2);
    
    if (! $resultData && checkMail($mail)){
        $resultData['success'] = false;
        $resultData['mesg'] = "Пользователь с таким мылом ('{$mail}') уже есть";
    }
    
    if (! $resultData){
        $passhash = md5($pass1);
        
        $usDat = NewUsrReg($mail, $passhash, $fio, $telephone, $adr);
        
        if ($usDat['success']){
            $resultData['mesg'] = 'Успешная регистрация';
            $resultData['success'] = 1;
            
            $usDat = $usDat[0]; //этой строкой мы делаем так, чтобы код в следующей строке обратился к 0 элементу массива, иначе пришлось бы записать $usDat[0]['fio']
            $resultData['nickName'] = $usDat['fio'] ? $usDat['fio'] : $usDat['mail'];
            $resultData['userMail'] = $mail;
            
            
            $_SESSION['usr'] = $usDat;
            $_SESSION['usr']['showName'] = $usDat['fio'] ? $usDat['fio'] : $usDat['mail'];
        }
        else {
            $resultData['success'] = 0;
            $resultData['mesg'] = 'ПОТРАЧЕНО регайтесь заново';
        }
        
        
    }
    echo json_encode($resultData);
//simpledebug($resultData);
}

function usrlogoutAction(){
    if(isset($_SESSION['usr'])){
        unset($_SESSION['usr']);
        unset($_SESSION['basket']);
        
    }
    redirect('/');
}

function usrloginAction($smarty){
    $mail = isset($_REQUEST['mail']) ? $_REQUEST['mail'] : null;
    $mail = trim($mail);
    
    $pass = isset($_REQUEST['pass']) ? $_REQUEST['pass'] : null;
    $pass = trim($pass);
    
    $usDat = logUsr($mail, $pass);
    
    if($usDat['success']){
        $usDat = $usDat[0];
        
        $_SESSION['usr'] = $usDat;
        $_SESSION['usr']['showName'] = $usDat['fio'] ? $usDat['fio'] : $usDat['mail'];
        
        $resultDat = $_SESSION['usr'];
        $resultDat['success'] = 1;
    }
    else{
        $resultDat['success'] = 0;
        $resultDat['mesg'] = 'Пароль или логинь неверны';
    }
    
    
  
    
    echo json_encode($resultDat);
    
}

//тут indexAction, т.к. http://myshop.local/u/  /u/, т.е. controller = ucontroller, а action у нас нет, он по умолчанию index; можно сделать ссылку /u/profile/ тогда будет profileAction
function indexAction($smarty){
    if (! isset($_SESSION['usr'])){
        redirect('/');
    }
    
    $dsCats = getAllMCWithChild();
    
    //полчучаем список заказов юзера
    $dsUsrOrd = getUsrOrds();
   // simpledebug($dsUsrOrd);
    $smarty->assign('pageName', 'Твоя инфа, не?');
    $smarty->assign('dsCats', $dsCats); 
    $smarty->assign('dsUsrOrd', $dsUsrOrd); 
    
    
    TemplateLoading($smarty, 'header');
    TemplateLoading($smarty, 'usr');
    TemplateLoading($smarty, 'footer');
}

function updAction(){
    if(! isset($_SESSION['usr'])){
        redirect('/');
    }
    
    $resultDat = array();
    $tel = isset($_REQUEST['telephone']) ? $_REQUEST['telephone'] : null;
    $adr = isset($_REQUEST['adr']) ? $_REQUEST['adr'] : null;
    $fio = isset($_REQUEST['fio']) ? $_REQUEST['fio'] : null;
    $pass1 = isset($_REQUEST['pass1']) ? $_REQUEST['pass1'] : null;
    $pass2 = isset($_REQUEST['pass2']) ? $_REQUEST['pass2'] : null;
    $crntPass = isset($_REQUEST['crntPass']) ? $_REQUEST['crntPass'] : null;
    //simpledebug($adr);
    $crntPassMD5 = md5($crntPass);
    if (! $crntPass || ($_SESSION['usr']['pass'] != $crntPassMD5)){
        $resultDat['success'] = 0;
        $resultDat['mesg'] = 'Неверный текущий пароль';
        echo json_encode($resultDat);
        return false; 
    }
    
    $result = updUsr($fio, $tel, $adr, $pass1, $pass2, $crntPassMD5);
   // simpledebug($result);
    if ($result){
        $resultDat['success'] = 1;
        $resultDat['mesg'] = 'данные сохранены';
        $resultDat['nickName'] = $fio; //т.к. она могла изменится и чтобы мы аяксом могли ее поменять в левом блоке мы записываем ее новое значение, но могла она не измениться, тогда сюда попадет прежнее значение
        
        $_SESSION['usr']['fio'] = $fio; //короче если переменные не были изменены, то в них по умолчанию запишуться старые значения
        $_SESSION['usr']['telephone'] = $tel;
        $_SESSION['usr']['adr'] = $adr;
        
            $nPass=$_SESSION['usr']['pass'];    //
            if ($pass1 && ($pass1==$pass2)){    //вот эта дичь нужна для того, чтобы моно было менять пароль постоянно, не перезаходя в аккаунт
                $nPass = md5(trim($pass1));                //
            }                                   //
        $_SESSION['usr']['pass'] = $nPass;
        $_SESSION['usr']['showName'] = $fio ? $fio : $_SESSION['usr']['mail'];
        
    }
    else{
        $resultDat['success'] = 0;
        $resultDat['mesg'] = 'Ошибка при сохранении данных';
    }
    
    echo json_encode($resultDat);
    
    
}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

