<?php

function newOrd($fio, $telephone, $adr){
    global $dbcon;
    $usrId = $_SESSION['usr']['id'];
    $comm = "id пользователя: {$usrId} </br>
Имя: {$fio} </br>
Телефон: {$telephone} </br> 
Адрес: {$adr}";
    $dateCreated = date('Y.m.d H:i:s');
    $usrIp = $_SERVER['REMOTE_ADDR'];
    
    // формирование запроса к БД
    
    $sqlcom = "INSERT INTO
        orders (`user_id`, `date_created`, `date_payment`, `status`, `comment`, `user_ip`)
        values ('$usrId', '$dateCreated', null, '0', '{$comm}', '{$usrIp}')";
        
    $dataset = mysqli_query($dbcon, $sqlcom);
    
    //получить id созданного заказа
    if ($dataset){
        $sqlcom = "Select id from orders order by id desc limit 1";
        $dataset = mysqli_query($dbcon, $sqlcom);
        $dataset = createSmartyDsArr($dataset);
        
        if (isset($dataset[0])){
            return $dataset[0]['id'];
        }
    }
    return false;
}


function getOrdsWithProdsUsr($usrId){
    global $dbcon;
    $usrId = intval($usrId);
    $sqlcom = "select * from orders where `user_id` = '{$usrId}' order by id desc";
    
    $dataset = mysqli_query($dbcon, $sqlcom);
    
    $smartyRs = array();
    while ($row = mysqli_fetch_assoc($dataset)){
        $dsChild = getPursForOrd($row['id']); //вот эта херня возвращает смарти массив, который умеет хранить массив в массиве
        
        if ($dsChild){
            $row['child'] = $dsChild;
            $smartyRs[] = $row; // вот в этой хрене храняться заказы и мы еще добавили ключик 'child' чтобы добавить все покупки для этого заказа
        }
    }
    return $smartyRs;
}

