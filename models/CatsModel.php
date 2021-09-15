<?php
//include_once '../config/db.php';
function getChildCats($catsid){  //получаем категории телефонов по фирмам
    global $dbcon;
    $sqlcom = "Select * from cats where par_id ='{$catsid}'";
    $dataset = mysqli_query($dbcon, $sqlcom);
    return createSmartyDsArr($dataset); 
}

function getAllMCWithChild() {
    global $dbcon;
    $sqlcom = 'SELECT * from cats where par_id = 0';
    $dataset = mysqli_query($dbcon, $sqlcom);
    // simpledebug($dataset);
    
    $smartyds = array();
      while($row = mysqli_fetch_assoc($dataset)){ //здесь мы получим просто телефоны и планшеты
      //  echo 'id = ' . $row['id'] . '<br />';
          $childds = getChildCats($row['id']);
          if ($childds){
              $row['child'] = $childds;  //Создаем доп. ключ child и по нему записываем дочерни элементы устройств по фирмам
          }
          $smartyds[] = $row;
    }
   // simpledebug($smartyds); 
    return $smartyds;
}


function getCByid($catid){
    global $dbcon;
    $catid = intval($catid); //преобразование в int, если была строка, то станет Int, нужна для защиты от sql инъекий
    $sqlcom = "select * from cats where id = '{$catid}'"; //одинарные кавычки нужны для избежания ошибок в запросе при null значениях
    
    $dataset = mysqli_query($dbcon, $sqlcom);
    
    return mysqli_fetch_assoc($dataset);
}
