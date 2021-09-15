<?php

include_once '../models/CatsModel.php';
include_once '../models/ProdsModel.php';
include_once '../library/mFunctions.php';

function testAction(){
    echo 'IndexController.php > testAction';
}

function indexAction($smarty){  //функция smarty, так и должнеа называться
    
   // $img = resize_image('img/prods/6.jpg', 200, 250);
  
    
    //simpledebug($rsCats);
   // simpledebug(); //проверка вызова функции
    //simpledebug($smarty);
    global $totalPages;
    $perpage=5;
    $pagenum=1;
    
     $total = countProds();
     $totalProds = $total['counttotal'];
  //   simpledebug($totalProds);
    $totalPages = ceil($totalProds / $perpage);
    $offset = ($perpage * $pagenum) - $perpage;
    
    $dsCats = getAllMCWithChild(); //получить набор данных data set
    $dsProd = getProdsForPage($offset, 5);
    
    $smarty->assign('pageName', 'Главная страница сайта');
    $smarty->assign('dsCats', $dsCats); //инициализируем переменную smarty 'dsCats' и записываем в нее значение $dsCats 
    $smarty->assign('dsProd', $dsProd);
    $smarty->assign('totalPages', $totalPages);
    
    TemplateLoading($smarty, 'header');
    TemplateLoading($smarty, 'index');
    TemplateLoading($smarty, 'footer');
}

