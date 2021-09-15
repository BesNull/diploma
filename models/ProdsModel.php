<?php

function getProdsForPage($offset=null, $perpage=null){
    global $dbcon;
    $sqlcom =  "SELECT * FROM `prod` ORDER BY `id` DESC";
    
    if($perpage){
        $sqlcom .= " LIMIT {$offset}, {$perpage}";
    }
    
    $dataset = mysqli_query($dbcon, $sqlcom);
    //simpledebug($dbcon);
    
    return createSmartyDsArr($dataset);
    
}

function countProds(){
    global $dbcon;
    $sqlcom = "select count(*) as counttotal from prod";
    $res = mysqli_query($dbcon, $sqlcom);
    $totalcount = mysqli_fetch_assoc($res);
    return $totalcount;
}

function getProdsByC($itemid){
    global $dbcon;
    $itemid = intval($itemid);
    $sqlcom = "select * from prod where cat_id = '{$itemid}' ";
    
    $dataset = mysqli_query($dbcon, $sqlcom);
    
    return createSmartyDsArr($dataset);
}

function getProdByid($itemid){
    global $dbcon;
    $itemid = intval($itemid);
    $sqlcom = "Select * from prod where id = '{$itemid}'";
    $dataset = mysqli_query($dbcon, $sqlcom);
    return mysqli_fetch_assoc($dataset);
}

function getProdsFromArr($itemsids){  
  //  simpledebug($itemsids); //ИД товаров которые закинуты в корзину
    global $dbcon;
    $stringids = implode($itemsids, ', '); ////ИД товаров которые закинуты в корзину, записанные строкой
  //  simpledebug($stringids);
    $sqlcom = "Select * from prod where id in ({$stringids})";
   // simpledebug($sqlcom);
    $dataset = mysqli_query($dbcon,$sqlcom);
    
    return createSmartyDsArr($dataset);
}

