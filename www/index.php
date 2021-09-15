<?php
//error_reporting(0);
session_start();




if (! isset($_SESSION['basket'])){
    $_SESSION['basket'] = array();
}

include_once '../config/config.php';
include_once '../config/db.php';
include_once '../library/mFunctions.php';

//определяем котроллер
$CtrlName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Index';   // ucfirst($_GET['controller'])

//echo 'Подключаемый php файл (контроллер) = ' . $CtrlName . '<br />';
//simpledebug($CtrlName, 0);
//определяем функцию
$ActName = isset($_GET['action']) ? $_GET['action'] : 'index'; // если не поймади значение переменной action, то по умолчанию запишем в неее index

if (isset($_SESSION['usr'])){
    $smarty->assign('authUsr', $_SESSION['usr']);
   // simpledebug($_SESSION['usr']);
}

//echo 'Функция формирующая страницу = ' .  $ActName . '<br />';
//simpledebug($smarty);
//include_once '../controllers/' . $CtrlName . 'Controller.php';  // в переменную записывается название контроллера и добавляется постфикс

//$function = $ActName . 'Action';

//echo 'Полное название вызываемой функции = ' . $function . '<br />';

//$function(); //переменная получила название функции из IndexController и вот так ее можно вызвать

$smarty->assign('basketcountitems', count($_SESSION['basket']));
//if (isset($_SESSION['basket']) && array_search($itemid, $_SESSION['basket']) === false) и добавить в смарти переменную, по ней определять, рисовать ли кнопку на странице товара или нет

PageLoading($smarty, $CtrlName, $ActName);
