<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 21.12.16
 * Time: 14:03
 */

class Info{

    private static $ini;

    private static function getini(){
        if(empty(self::$ini)) {
            self::$ini = require dirname(__DIR__) . '/config.php';
        }
        return self::$ini;
    }

    public static function get($val = '', $type='base'){
        self::getini();

        if($val == 'ALL'){
            $r['ALL'] = self::$ini;
        }else{
            $r= self::$ini[$type][$val];
        }
        return $r;
    }

    public static function get_db($param = '', $name = 'default'){
        self::getini();

        if(empty($param)){
            $r = self::$ini['database'][$name];
        }else{
            $r = self::$ini['database'][$name][$param];
        }
            /*echo '<pre>';
            print_r(self::$ini);
            echo '</pre>';
            exit('xxx');*/
        return $r;


    }

    public static function getUri($s = 0, $f = 200){
        $res = explode('/', strtok($_SERVER['REQUEST_URI'], '?'));
        $r = array_slice($res, $s, $f);
        return new URL($r);
    }
}

class URL{
    public static $array_url = array();
    public function __construct($array_url)
    {
        self::$array_url = $array_url;
    }

    public function all(){

        foreach (self::$array_url as $key => $val)
            if (is_numeric($val)) // only numbers, a point and an `e` like in 1.1e10
                unset(self::$array_url[$key]);
        return implode('/', self::$array_url);
    }
    public function only(){
        return @self::$array_url[0];
    }
}