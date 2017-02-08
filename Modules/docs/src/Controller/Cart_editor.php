<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 27.12.16
 * Time: 10:05
 */
namespace Module\shop\Controller;
class Cart_editor{
    public static function up($id){
        $_SESSION[session_id()]['cart']['products'][$id]['count']++;
        $_SESSION[session_id()]['cart']['count']++;
    }
    public static function down($id){


        if($_SESSION[session_id()]['cart']['products'][$id]['count'] == 1 ){
            self::cancel($id);
        }else{
            $_SESSION[session_id()]['cart']['products'][$id]['count']--;
            $_SESSION[session_id()]['cart']['count']--;
        }
    }
    public static function cancel($id = 0){
        $c = $_SESSION[session_id()]['cart']['products'][$id]['count'];
        $_SESSION[session_id()]['cart']['count'] = $_SESSION[session_id()]['cart']['count'] - $c;
        unset($_SESSION[session_id()]['cart']['products'][$id]);
    }
    public static function getproductsincart($id = 'ALL'){
        if($id == 'ALL'){
            $res = $_SESSION[session_id()]['cart']['products'];
        }else{
            $res = $_SESSION[session_id()]['cart']['products'][$id];
        }
        return $res;
    }
}
?>