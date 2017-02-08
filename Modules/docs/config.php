<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 05.01.2017
 * Time: 14:13
 */


Template::addScript('docs/scrollspy.js');
Template::addStyle('admin/metisMenu.min.css');
Template::addScript('admin/metisMenu.min.js');

require_once Rout::on(__DIR__);