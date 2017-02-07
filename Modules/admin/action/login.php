<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 28.12.16
 * Time: 11:36
 */
$email    = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$logoff = Info::getUri('4');

if($email == 'test@email.com' && $password == '12321'){
    setcookie("session_on", md5($email.'good day'), time()+3600, '/');
}elseif ($logoff == 'logout'){
    setcookie ("session_on", "", time() - 3600, '/');
}
header('Location: /admin');