<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 22.12.16
 * Time: 15:47
 */
header('Content-Type: text/html; charset=utf-8');
class Rout extends Info {
    public static function on($dir){

        if(self::getUri('2')->only() == 'action' && !empty(self::getUri('3')->only())){
            Template::$tmp = false;
            $file = $dir.'/action/'.self::getUri('3')->all().'.php';
        }
        elseif( Template::getUri('2')->only() != '' ) {
            $file = $dir . '/view/' . Template::getUri('2')->all().'.php';
        }elseif( Template::getUri('2')->only() == '' ){
            $file = $dir . '/view/index.php';
        }

/*        echo $file;
        die;*/
        return self::check404($file);
    }

    public static function routing(){

        $root_dir = Info::get('root_dir');
        //Подключаем виджеты
        self::widgets();

        $file = 'error';
        if(self::getUri('1')->only() == ''){
            $file = $root_dir."/Modules/index/config.php";
        }elseif(self::getUri('1')->only() == 'style' && empty(self::getUri('3')->only())){
            header("Content-type: text/css");
            Template::$tmp = false;
            $file = $root_dir.'/Templates/'.Info::get('template').'/style/'.self::getUri('2')->only();
        }elseif(self::getUri('1')->only() == 'script' && empty(self::getUri('3')->only())){
            header('Content-Type: application/javascript');
            Template::$tmp = false;
            $file = $root_dir.'/Templates/'.Info::get('template').'/script/'.self::getUri('2')->only();
        }elseif(self::getUri('1')->only() == 'img' && empty(self::getUri('3')->only())) {
            header("Content-Type: image/jpeg");
            Template::$isimg = true;
            Template::$tmp = false;
            $file = $root_dir . '/Templates/' . Info::get('template') . '/img/' . self::getUri('2')->only();
        }elseif(self::getUri('1')->only() == 'tmp' && !empty(self::getUri('3')->only())){
            Template::$tmp = false;
            $file = $root_dir.'/Templates/'.self::getUri('2')->all();
        }elseif (self::getUri('1')->only() == 'style' && !empty(self::getUri('3')->only())){
            header("Content-type: text/css");
            Template::$tmp = false;
            $file = $root_dir.'/Modules/'.self::getUri('2')->only().'/style/'.self::getUri('3')->all();
        }elseif (self::getUri('1')->only() == 'script' && !empty(self::getUri('3')->only())){
            header('Content-Type: application/javascript');
            Template::$tmp = false;
            $file = $root_dir.'/Modules/'.self::getUri('2')->only().'/script/'.self::getUri('3')->all();
        }elseif (self::getUri('1')->only() == 'img' && !empty(self::getUri('3')->only())){
            header("Content-Type: image/jpeg");
            Template::$isimg = true;
            Template::$tmp = false;
            $file = $root_dir.'/Modules/'.self::getUri('2')->only().'/img/'.self::getUri('3')->all();
        }
        else{
            $file = $root_dir.'/Modules/'.self::getUri('1')->only().'/config.php';
        }

        //Проверям что файл существует:
        /*if(empty(file_exists($file))){
            $file = $root_dir.'/Templates/default/error/404.phtml';
        }*/
        //echo $file);
        return self::check404($file);
    }

    private static function check404($file){
        if(empty(file_exists($file))){
            $file = Info::get('root_dir').'/Templates/default/error/404.phtml';
        }else{
            $file = $file;
        }
        return $file;
    }

    private static function widgets(){
        $root_dir = Info::get('root_dir');
        $x = require $root_dir.'/Widgets/config.php';
        if(count($x)<1) return;

        foreach ($x as $k=>$v){
            $file = $root_dir.'/Widgets/'.$v.'.php';
            if(file_exists($file)) {
                ob_start();
                require_once $file;
                $ob = ob_get_contents();
                ob_clean();
                Template::addTeg($k, $ob);
            }else{
                echo '<p style="color: red; border-bottom: solid 1px cornflowerblue; background: #ffc2c2; margin: 0px; padding: 10px;">Виджет "'.$v.'" не найден!</p>';
            }
        }
    }
}