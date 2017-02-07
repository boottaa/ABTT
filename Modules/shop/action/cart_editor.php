<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 27.12.16
 * Time: 10:05
 */
use Module\shop\Controller\Cart_editor;

$id = filter_input(INPUT_POST, 'id');
$action = filter_input(INPUT_POST, 'action');
if (empty($id) || empty($action)){
    exit('Хакер что ли?');
}
Cart_editor::$action($id);