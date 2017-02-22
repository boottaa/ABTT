<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 21.12.16
 * Time: 18:38
 */

class Template extends Info {

    protected static
        $styles = '',
        $scripts = '',
        $str = array(),//
	    $title='',
	    $tmp=true;

    public static function addTeg($teg, $replase=''){
	    if ($teg){
            self::$str['search'][] = $teg;
            self::$str['replase'][] = $replase;
	    }
    }

    public static function addScript($script){
        $site = Info::get('site');

        self::$scripts .= "<script src='{$site}/script/{$script}'></script>".PHP_EOL;
    }

    public static function addStyle($style){
        $site = Info::get('site');
        self::$styles .= "<link rel='stylesheet' type='text/css' href='{$site}/style/{$style}'>".PHP_EOL;
    }

    public static function set_title($name){
	    self::$title = $name;
    }

    public static function set_tmp($tmp){
	    self::$tmp = $tmp;
    }

}