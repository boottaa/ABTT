<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 23.12.16
 * Time: 14:07
 */


session_start();
if(empty($_SESSION[session_id()]['cart']['count'])){
    $_SESSION[session_id()]['cart']['count'] = '0';
}

?>

<a href="{% SITE %}/shop/cart" type="button" class="btn btn-default pull-right acart" style="margin-top: 20px;"><span class="badge"><?=$_SESSION[session_id()]['cart']['count'] ?></span>&nbsp; Корзина</a>