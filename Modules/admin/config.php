<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 23.12.16
 * Time: 13:54
 */

Template::$tmp = 'off';
Template::$title = 'Alfa Admin';
Template::addStyle('admin/bootstrap.min.css');
Template::addStyle('admin/metisMenu.min.css');
Template::addStyle('admin/sb-admin-2.css');
Template::addStyle('admin/morris.css');
Template::addStyle('admin/font-awesome.min.css');
Template::addScript('admin/jquery.min.js');

Template::addScript('admin/bootstrap.min.js');
Template::addScript('admin/metisMenu.min.js');

Template::addScript('admin/raphael.min.js');
Template::addScript('admin/morris.min.js');
Template::addScript('admin/flot/jquery.flot.js');
Template::addScript('admin/morris-data.js');

Template::addScript('admin/flot/jquery.flot.time.js');
Template::addScript('admin/flot/jquery.flot.canvas.js');
Template::addScript('admin/sb-admin-2.js');
Template::addStyle('admin/morris.css');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$sesionid = session_id();

$ip = ip2long($_SERVER["REMOTE_ADDR"]);
require_once Rout::on(__DIR__);