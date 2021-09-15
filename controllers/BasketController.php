<?php
error_reporting(0);

include_once '../models/CatsModel.php';
include_once '../models/ProdsModel.php';
include_once '../models/OrdModel.php';
include_once '../models/PurModel.php';

function addtobasketAction(){
    $itemid = isset($_GET['id']) ? intval($_GET['id']) : null;
    if (! $itemid) return false;
    
    $resultData = array();
    
    //если значения нет, то добавляем
    if (isset($_SESSION['basket']) && array_search($itemid, $_SESSION['basket']) === false){   //вот тут как раз проверяется, добавится ли товар и пропадет ли кнопка "добавить в корзину"
//basket Инициализировали  в index.php
        $_SESSION['basket'][] = $itemid; //добавляем элемент в массив корзины
        $resultData['countitems'] = count($_SESSION['basket']);
        $resultData['success'] = 1;
    }
    // simpledebug($resultData);
    else {
        $resultData['success'] = 0;
    }
    echo json_encode($resultData);
  //  error_reporting(E_ALL);
   // simpledebug(json_encode($resultData));
}

function remfrombasketAction(){
    $itemid = isset($_GET['id']) ? intval($_GET['id']) : null;
    if (! $itemid) exit();
    
    $resultData = array();
    $key = array_search($itemid, $_SESSION['basket']);
    if($key !== false){
        unset($_SESSION['basket'][$key]); // удаляенм такой элемент массива по ключу
        $resultData['success'] = 1;
        $resultData['countitems'] = count($_SESSION['basket']);
    }
    else {
        $resultData['success'] = 0;
    }
    echo json_encode($resultData);
}

function indexAction($smarty){
    $itemsids = isset($_SESSION['basket']) ? $_SESSION['basket'] : array();
    
    $dsCats = getAllMCWithChild();
    $dsProds = getProdsFromArr($itemsids);
    
    $smarty->assign('pageName', 'Борщина');
    $smarty->assign('dsCats', $dsCats);
    $smarty->assign('dsProds', $dsProds);
    
    TemplateLoading($smarty, 'header');
    TemplateLoading($smarty, 'basket');
    TemplateLoading($smarty, 'footer');
}


function ordAction($smarty){  //в basket.tpl делаем Post запрос
    //simpledebug($_POST);
    //получаем массив идентификаторов корзины
    $itemIds = isset($_SESSION['basket']) ? $_SESSION['basket'] : null;
    //если корзина пуста то редиректим
    if (!$itemIds){
        redirect('/basket/');
        return;
    }
    
    //получаем  из массива $_post кол-во покупаемых товаров
    $itemscount = array();
    foreach($itemIds as $item){
        //формируем ключ для массива post
        $postVar = 'itemcount_' . $item;  // itemcount_ значение берем, как в ПОСТ запросе, его дебаг показан на первой строке функции
        //создаем элемент массива кол-ва покупаемого товара
        //ключ массива - ID Товара, значение массива - кол-во товара
        //$itemscount[1] = 3  товар с id = 1 в кол-ве 3 штука
        $itemscount[$item] = isset($_POST[$postVar]) ? $_POST[$postVar] : null;
    }
    
    // получаем список продуктов по массиву корзины
    $dsProds = getProdsFromArr($itemIds);
    //simpledebug($dsProds);
    //добавляем каждому продукту доп. поле
    //overallPrice = кол-во 
    //count  = кол-во товара
    //&$item - Для того, чтобы при изменении переменной  $item менянлся и элемент массива $dsProds
    $i = 0;
    foreach($dsProds as &$item){
        $item['count'] = isset($itemscount[$item['id']]) ? $itemscount[$item['id']] : 0;
        if ($item['count']){
            $item['overallPrice'] = $item['count'] * $item['price'];
        }
        else{
            //если вдруг товар в корзине есть, но кол-во его равно нулю
            unset($dsProds[$i]);
        }
        $i++;
    }
    
    if (!$dsProds){
        echo "Корзина пуста";
        return;
    }
    
    // полученный массив покупаемых товаров заносим в сесионную переменную
    $_SESSION['ordBasket'] = $dsProds;
    
    $dsCats = getAllMCWithChild();
    
    //флаги для хайда блоков реги и ауфа
    if (! isset($_SESSION['usr'])){
        $smarty->assign('HideRegAuth', 1);
    }
    
    $smarty->assign('pageName', 'Ну че, брать будешь?');
    $smarty->assign('dsCats', $dsCats); 
    $smarty->assign('dsProds', $dsProds); 
    
    TemplateLoading($smarty, 'header');
    TemplateLoading($smarty, 'ord');
    TemplateLoading($smarty, 'footer');
}

function confirmordAction(){
    
    $basket = isset($_SESSION['ordBasket']) ? $_SESSION['ordBasket'] : null;
    
    if (!$basket){
        $resultDat['success'] = 0;
        $resultDat['mesg'] = 'net tovarov';
        echo json_encode($resultDat);
        return;
    }
    
    $fio = $_POST['fio'];
    $telephone = $_POST['telephone'];
    $adr = $_POST['adr'];
    
    $ordId = newOrd($fio, $telephone, $adr);
    //simpledebug($ordId);
    if (! $ordId){
        $resultDat['success'] = 0;
        $resultDat['mesg'] = "ошибка сохранения заказа";
        echo json_encode($resultDat);
        return;
    }
    
    //Добавляеми товары в созданный заказ
    $result = addPurToOrd($ordId, $basket);
    
    if ($result){
        $resultDat['success'] = 1;
        $resultDat['mesg'] = 'Заказ сохранен';
        unset($_SESSION['ordBasket']);
        unset($_SESSION['basket']);
    }
    else{
        $resultDat['success'] = 0;
        $resultDat['mesg'] = 'Ошибка внесения данных для  заказа №' . $ordId;
    }
    
    echo json_encode($resultDat);
}