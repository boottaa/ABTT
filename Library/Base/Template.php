<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 21.12.16
 * Time: 18:38
 */

class Template extends Info {
    public static
        $title='',
        $isimg = false,
        $tmp=true;

    private static
        $site = '',
        $styles = '',
        $scripts = '',
        $str = array();



    public static function mod(){

        $file = Rout::routing();

        if(self::$isimg == true){
            $fp = fopen($file, 'rb');
            fpassthru($fp);
            exit();
        }



        ob_start();

        require_once $file;
        $ob_contents = ob_get_contents();
        ob_clean();

        if(is_bool(self::$tmp) && self::$tmp == true){
            ob_start();
            require_once '../Templates/'.Info::get('template').'/index.phtml';
            $ob_template = ob_get_contents();
            ob_clean();
            $html = str_replace('{% CONTENT %}', $ob_contents, $ob_template);
        }elseif(is_bool(self::$tmp) && self::$tmp == false){
            $html = $ob_contents;
        }elseif(is_string(self::$tmp)){
            ob_start();
            require_once '../Templates/'.self::$tmp.'/index.phtml';
            $ob_template = ob_get_contents();
            ob_clean();

            $html = str_replace('{% CONTENT %}', $ob_contents, $ob_template);
        }

        return self::tegs($html);

        //preg_match_all('/{%.([A-Z]+)(:\"?([A-z�-�].+)\"?)?.%}/Um', $html, $SpecialTegs);
        //return $SpecialTegs;
    }
    public static function addTeg($teg, $replase=''){
        self::$str['search'][] = $teg;
        self::$str['replase'][] = $replase;
    }

    public static function addScript($script){
        $site = Info::get('site');

        self::$scripts .= "<script src='{$site}/script/{$script}'></script>".PHP_EOL;
    }

    public static function addStyle($style){
        $site = Info::get('site');
        self::$styles .= "<link rel='stylesheet' type='text/css' href='{$site}/style/{$style}'>".PHP_EOL;
    }

    private static function tegs($content){
        self::$site = parent::get('site');

        self::$str['search'][] = '{% SITE %}';
        self::$str['replase'][] = self::$site;
        self::$str['search'][] = '{% TITLE %}';
        self::$str['replase'][] = self::$title;
        self::$str['search'][] = '{% STYLES %}';
        self::$str['replase'][] = self::$styles;
        self::$str['search'][] = '{% SCRIPTS %}';
        self::$str['replase'][] = self::$scripts;

        return str_replace(self::$str['search'], self::$str['replase'], $content);
    }
}