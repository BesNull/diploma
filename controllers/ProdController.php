<?php

include_once '../models/CatsModel.php';
include_once '../models/ProdsModel.php';

function indexAction($smarty) {
    $itemid = isset($_GET['id']) ? $_GET['id'] : null;
    if ($itemid == null) exit();
    
    $dsProd = getProdByid($itemid);
    
    $dsCats = getAllMCWithChild();
    
    $smarty->assign('checkProdInBasket', 0);
    if(in_array($itemid, $_SESSION['basket'])){
        $smarty->assign('checkProdInBasket', 1);
    }
    
    $smarty->assign('pageName', '');
    $smarty->assign('dsCats', $dsCats); 
    $smarty->assign('dsProd', $dsProd);

    
    TemplateLoading($smarty, 'header');
    TemplateLoading($smarty, 'prod');
    TemplateLoading($smarty, 'footer');
        
        
}

