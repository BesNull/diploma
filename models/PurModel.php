<?php

 function addPurToOrd($ordId, $basket){
     global $dbcon;
    // simpledebug($basket);
     $sqlcom = "insert into purchase (order_id, product_id, price, amount) values ";
     
     $values = array();
     //формируем строки для запрса для кажого товара
     foreach ($basket as $item) {
         $values[] = "('{$ordId}', '{$item['id']}', '{$item['price']}', '{$item['count']}')";
     }
     
     $sqlcom .= implode(', ', $values);
    // simpledebug($sqlcom);
     $dataset = mysqli_query($dbcon, $sqlcom);
     
     return $dataset;
     
 }
 
 function getPursForOrd($ordId){
     global $dbcon;
     $sqlcom = "select `pe`.*, `pd`.name "
             . "from purchase as `pe` "
             . "join prod as `pd` on `pe`.product_id = `pd`.id "
             . "where `pe`.order_id = {$ordId}";
    // simpledebug($sqlcom);
             
    $dataset = mysqli_query($dbcon, $sqlcom);
    return createSmartyDsArr($dataset);
 }


