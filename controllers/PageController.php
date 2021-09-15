<?php


include_once '../models/CatsModel.php';
include_once '../models/ProdsModel.php';

function testAction(){
    echo 'IndexController.php > testAction';
}

function indexAction($smarty){  //функция smarty, так и должнеа называться
    global $pagenum;
    global $perpage;
    global $totalPages;
    $perpage =5;
    $pagenum = isset($_GET['id']) ? $_GET['id'] : null; // короче прикол в том, что вписывая id мы можем сделать /page/2/ ,а если $_get['pagenum'], то он не видит ее и надо вручную фигачить /page/?pagenum=2
    //$pagenum = ((int) $_GET['id']);  // вот тут можно чекнуть, ловится ли переменная, енсли нет, то выйдет ошибка, сверху ошибки не будет
    if ($pagenum == null) exit();
//simpledebug($pagenum);
     $total = countProds();
     $totalProds = $total['counttotal'];
  //   simpledebug($totalProds);
    $totalPages = ceil($totalProds / $perpage);
    $offset = ($perpage * $pagenum) - $perpage; //нужна для sql Запроса getProdsForPage для определние, с какого места таблицы брать товары
    
    
    //simpledebug($totalPages);
    //simpledebug($rsCats);
   // simpledebug(); //проверка вызова функции
    //simpledebug($smarty);
    
    $dsCats = getAllMCWithChild(); //получить набор данных data set
    $dsProd = getProdsForPage($offset, $perpage);
    
    $smarty->assign('pageName', $pagenum);
    $smarty->assign('pagenum', $pagenum);
    $smarty->assign('totalPages', $totalPages);
    $smarty->assign('dsCats', $dsCats); //инициализируем переменную smarty 'dsCats' и записываем в нее значение $dsCats 
    $smarty->assign('dsProd', $dsProd);
    
    TemplateLoading($smarty, 'header');
    TemplateLoading($smarty, 'page');
    TemplateLoading($smarty, 'footer');
}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

