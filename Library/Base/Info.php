<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 21.12.16
 * Time: 14:03
 */

class Info{

    private static $config;

    private static function getconfig(){
        if(empty(self::$config)) {
            self::$config = require dirname(__DIR__) . '/config.php';
        }
        return self::$config;
    }

    public static function get($val = '', $type='base'){
        self::getconfig();

        if($val == 'ALL'){
            $r['ALL'] = self::$config;
        }else{
            $r= self::$config[$type][$val];
        }
        return $r;
    }

    public static function get_db($param = '', $name = 'default'){
        self::getconfig();

        if(empty($param)){
            $r = self::$config['database'][$name];
        }else{
            $r = self::$config['database'][$name][$param];
        }
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
            if (is_numeric($val))
                unset(self::$array_url[$key]);
        return implode('/', self::$array_url);
    }
    public function only(){
        return @self::$array_url[0];
    }
}