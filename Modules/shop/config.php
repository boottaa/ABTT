<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 23.12.16
 * Time: 13:54
 */
Template::$tmp = true;
Template::$title = 'Alfa Shop';
Template::addStyle('shop/shopstyle.css');
Template::addScript('shop/cart.js');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$sesionid = session_id();
//session_destroy();
$_SESSION[$sesionid]['cart']['count'] ;

$ip = ip2long($_SERVER["REMOTE_ADDR"]);
require_once Rout::on(__DIR__);