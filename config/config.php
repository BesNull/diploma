<?php

define('PPrx', '../controllers/');
define('PPostfx', 'Controller.php');

//юзаем шаблон
$template = 'default';

//пути к шаблонам .tpl
define ('TemplatePrefix', "../views/{$template}/");
define ('TemplatePostfix', '.tpl');

// пути к файлам шаблонов в вэбе
define ('TemplateWebPath', "/templates/{$template}/");

//инициализация Smarty
require ('../library/Smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir(TemplatePrefix);
$smarty->setCompileDir('../tmp/smarty/templates_c');
$smarty->setCompileDir('../tmp/smarty/cache');
$smarty->setCompileDir('../library/Smarty/configs');
        
$smarty->assign('templWebPth', TemplateWebPath);