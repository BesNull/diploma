<?php

include_once '../models/CatsModel.php';
include_once '../models/ProdsModel.php';

function indexAction($smarty){    
    $catid = isset($_GET['id']) ? $_GET['id'] : null;
    if ($catid == null) exit();
    
    $dsProd = null;
    $dsCatChild = null;
    
    $dsCat = getCByid($catid);
   // simpledebug($dsCat);
    
    //если главная категория, то шоу чайлд, иначе шоу товар
    if($dsCat['par_id']==0){
        $dsCatChild = getChildCats($catid);
    }
    else{
         $dsProd = getProdsByC($catid);
    }
    
    
    $dsCats = getAllMCWithChild(); 
  
    $smarty->assign('pageName', 'Категории товаров' . $dsCat['name']);
    
    $smarty->assign('dsCat', $dsCat); 
    $smarty->assign('dsProd', $dsProd);
    $smarty->assign('dsCatChild', $dsCatChild);
    $smarty->assign('dsCats', $dsCats);
    
    TemplateLoading($smarty, 'header');
    TemplateLoading($smarty, 'cat');
    TemplateLoading($smarty, 'footer');
}
