<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 21.12.16
 * Time: 13:43
 * memory_get_usage(false)/1024/1024;
 */
/*echo '<pre>';
print_r($_SERVER);
echo '</pre>';
exit();*/
require_once '../loader.php';

// set to the user defined error handler
set_error_handler("Dashboard::ErrorHandler");

if(Info::get('devolper') == 'devolper'){
    Dashboard::start();
}

$html = Rout::int();

if(Info::get('devolper') == 'devolper'){
    Dashboard::end();
    //Подкрепляем DASHBOARD
    Dashboard::view_statistics($html);
}

echo $html



?>




