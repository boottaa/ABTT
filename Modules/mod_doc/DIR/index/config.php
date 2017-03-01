<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 22.12.16
 * Time: 11:21
 */

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

Template::addScript('admin/newChat.js');
Template::addStyle('admin/sb-admin-2.css');

require_once Rout::on(__DIR__);
?>
