<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 26.12.16
 * Time: 12:38
 */
use Module\shop\Model\Products;
$id = Info::getUri('4')->only();
$res = Products::getproduct($id);

$name = $res['name'];
$price = $res['price'];
$img   = $res['img'];
$Manufacturer = $res['Manufacturer'];
//session_destroy();

if(empty($_SESSION[$sesionid]['cart']['products'][$id])){
    $_SESSION[$sesionid]['cart']['products'][$id]['count'] = 1;
    $_SESSION[$sesionid]['cart']['products'][$id]['name'] = $name;
    $_SESSION[$sesionid]['cart']['products'][$id]['price'] = $price;
    $_SESSION[$sesionid]['cart']['products'][$id]['img'] = $img;
    $_SESSION[$sesionid]['cart']['products'][$id]['Manufacturer'] = $Manufacturer;
}else{
    $_SESSION[$sesionid]['cart']['products'][$id]['count']++;
}
$_SESSION[$sesionid]['cart']['count']++;

echo '<script>window.history.back();</script>';
?>