<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 21.12.16
 * Time: 13:43
 * memory_get_usage(false)/1024/1024;
 */



require_once '../loader.php';

// set to the user defined error handler
set_error_handler("Dashboard::ErrorHandler");

Dashboard::start();
echo Template::mod();
Dashboard::end();

Dashboard::view_statistics();

//$info = 'Затрачено мб: '.round(($ramEnd - $ramStart)/1024/1024, 3).' Затрачено времени: '.round($timeEnd - $timeStart, 3).' микросекунд';
//position: fixed; left: 0px; bottom: 0px; width: 100%; padding: 0px; margin: 0px;
/*<!-------------Проблема Джава скрипты не грузятся из за того что тут что то написано. ------------>
<!--<nav class="navbar navbar-inverse navbar-fixed-bottom" style="border-radius: 0px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <b class="navbar-brand">Devolper </b>
            <p class="navbar-text navbar-right"> $info </p>
</div>
</div>
</nav>-->*/
?>