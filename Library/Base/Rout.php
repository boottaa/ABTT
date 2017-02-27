<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 22.12.16
 * Time: 15:47
 */
header('Content-Type: text/html; charset=utf-8');

/**
 * Class Rout
 */
class Rout extends Template {


	private static $isimg = false;

	/**
	 * @param $dir
	 * @return string
	 */
    public static function on($dir){
        if(parent::getUri('2')->only() == 'action' && !empty(parent::getUri('3')->only())){
	        parent::$tmp = false;
            $file = $dir.'/action/'.parent::getUri('3')->all().'.php';
        }
        elseif( parent::getUri('2')->only() != '' ) {
            $file = $dir . '/view/' . parent::getUri('2')->all().'.php';
        }elseif( parent::getUri('2')->only() == '' ){
            $file = $dir . '/view/index.php';
        }
        return self::check404($file);
    }


	public static function int(){

		$file = self::routing();

		if(self::$isimg == true){
			$fp = fopen($file, 'rb');
			fpassthru($fp);
			exit();
		}

		ob_start();

		require_once $file;
		$ob_contents = ob_get_contents();
		ob_clean();

		if(is_bool(parent::$tmp) && parent::$tmp == true){
			ob_start();
			require_once '../Templates/'.Info::get('template').'/index.phtml';
			$ob_template = ob_get_contents();
			ob_clean();
			$html = str_replace('{% CONTENT %}', $ob_contents, $ob_template);
		}elseif(is_bool(parent::$tmp) && parent::$tmp == false){
			$html = $ob_contents;
		}elseif(is_string(parent::$tmp)){
			ob_start();
			require_once '../Templates/'.parent::$tmp.'/index.phtml';
			$ob_template = ob_get_contents();
			ob_clean();
			$html = str_replace('{% CONTENT %}', $ob_contents, $ob_template);
		}
		return self::tegs($html);
		//preg_match_all('/{%.([A-Z]+)(:\"?([A-z�-�].+)\"?)?.%}/Um', $html, $SpecialTegs);
		//return $SpecialTegs;
	}

	private static function tegs($content){

		parent::$str['search'][] = '{% SITE %}';
		parent::$str['replase'][] = parent::get('site');
		parent::$str['search'][] = '{% TITLE %}';
		parent::$str['replase'][] = parent::$title;
		parent::$str['search'][] = '{% STYLES %}';
		parent::$str['replase'][] = parent::$styles;
		parent::$str['search'][] = '{% SCRIPTS %}';
		parent::$str['replase'][] = parent::$scripts;

		return str_replace(parent::$str['search'], parent::$str['replase'], $content);
	}

     private function routing(){

        $root_dir = Info::get('root_dir');
        //Подключаем виджеты
        self::widgets();

        $file = 'error';
        if(parent::getUri('1')->only() == ''){
            $file = $root_dir."/Modules/index/config.php";
        }elseif(parent::getUri('1')->only() == 'style' && empty(parent::getUri('3')->only())){
            header("Content-type: text/css");
            parent::$tmp = false;
            $file = $root_dir.'/Templates/'.Info::get('template').'/style/'.parent::getUri('2')->only();
        }elseif(parent::getUri('1')->only() == 'script' && empty(parent::getUri('3')->only())){
            header('Content-Type: application/javascript');
            parent::$tmp = false;
            $file = $root_dir.'/Templates/'.Info::get('template').'/script/'.parent::getUri('2')->only();
        }elseif(parent::getUri('1')->only() == 'img' && empty(parent::getUri('3')->only())) {
            header("Content-Type: image/jpeg");
            parent::$isimg = true;
            parent::$tmp = false;
            $file = $root_dir . '/Templates/' . Info::get('template') . '/img/' . parent::getUri('2')->only();
        }elseif(parent::getUri('1')->only() == 'tmp' && !empty(parent::getUri('3')->only())){
            parent::$tmp = false;
            $file = $root_dir.'/Templates/'.parent::getUri('2')->all();
        }elseif (parent::getUri('1')->only() == 'style' && !empty(parent::getUri('3')->only())){
            header("Content-type: text/css");
            parent::$tmp = false;
            $file = $root_dir.'/Modules/'.parent::getUri('2')->only().'/style/'.parent::getUri('3')->all();
        }elseif (parent::getUri('1')->only() == 'script' && !empty(parent::getUri('3')->only())){
            header('Content-Type: application/javascript');
            parent::$tmp = false;
            $file = $root_dir.'/Modules/'.parent::getUri('2')->only().'/script/'.parent::getUri('3')->all();
        }elseif (parent::getUri('1')->only() == 'img' && !empty(parent::getUri('3')->only())){
            header("Content-Type: image/jpeg");
            parent::$isimg = true;
            parent::$tmp = false;
            $file = $root_dir.'/Modules/'.parent::getUri('2')->only().'/img/'.parent::getUri('3')->all();
        }
        else{
            $file = $root_dir.'/Modules/'.parent::getUri('1')->only().'/config.php';
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
                parent::addTeg($k, $ob);
            }else{
                echo '<p style="color: red; border-bottom: solid 1px cornflowerblue; background: #ffc2c2; margin: 0px; padding: 10px;">Виджет "'.$v.'" не найден!</p>';
            }
        }
    }
}