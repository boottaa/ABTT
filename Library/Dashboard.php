<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 29.01.2017
 * Time: 0:39
 */
class Dashboard extends Template {
    static private $info, $errors = array();
    //Определяет будет ли виден дашбоард
    static public $view = true;

    //Начинает сбор статистики
    public static function start()
    {
        self::$info['start_time'] = microtime(true);
        self::$info['start_ram'] = memory_get_usage(false);
    }
    public static function end(){
        self::$info['end_time'] = microtime(true);
        self::$info['end_ram'] = memory_get_usage(false);
        self::$info['memory_get_peak_usage'] = memory_get_peak_usage(false)/1024/1024;
        self::$info['using_ram_mb'] = (self::$info['end_ram'] - self::$info['start_ram'])/1024/1024;
        self::$info['using_time'] = self::$info['end_time'] - self::$info['start_time'];
        //Получаем все подключенные файлы.
        self::$info['get_included_files'] = get_included_files();
    }
    public static function get_info($need = ''){
        $result = array();
        if($need == ''){
            $result = self::$info;
        }else{
            if(!empty(self::$info[$need])){
                $result[$need] = self::$info[$need];
            }else{
                $result[$need] = 'Ошибка: элемент не найден';
            }
        }
        return $result;
    }
    //Выводит html форму статистики.
    public static function view_statistics(){
        //вывод запросов в бд
        $query = SQL::get_all_query();
        $getErrors = self::$errors;
        $html = '';
        $query_html = '';
        $error_html = '';
        $get_included_files = '';

        if(parent::$tmp != false && self::$view == true)
        {
            $html_info = 'Затрачено мб: [ '.round(self::$info['using_ram_mb'], 3).' ] Пиковое значение мб: [ '.round(self::$info['memory_get_peak_usage'], 3).' ] Затрачено времени: [ '.round(self::$info['using_time'], 3).' ] микросекунд';
            if(count($getErrors) != 0)
            {
                foreach ($getErrors as $error)
                {
                    $error_html .= "<li>$error<hr /></li>";
                }
            }else{
                $error_html .= "<li>Ошибок нет<hr /></li>";
            }

            if(count(self::$info['get_included_files'] != 0)){
                foreach (self::$info['get_included_files'] as $get_included_file)
                {
                    $get_included_files .= "<li>{$get_included_file}<hr /></li>";
                }
            }else{
                $get_included_files .= "<li>Запросов в бд нет<hr /></li>";
            }

            if(count($query) != 0)
            {
                foreach ($query as $value)
                {
                    $query_html .= "<li>$value<hr /></li>";
                }
            }else{
                $query_html .= "<li>Запросов в бд нет<hr /></li>";
            }

            $html .= "
            <style>
                .dashboard-addpanel{
                    display: none;
                    position: absolute;
                    clear: both;
                    width: 100%;
                    left: 0px;
                    bottom: 50px;
                    margin: 0px;
                    padding: 0px;
                    background: rgb(204, 204, 204) none repeat scroll 0% 0%;
                    padding: 10px 23px;
                    border: solid 2px black;
                    list-style: none;
                    max-height: 400px;
                    overflow-y: auto;
                }
            </style>
            <nav class='navbar navbar-inverse navbar-fixed-bottom' style='z-index: 999999; border-radius: 0px;'>
                <ul class='dropdown-menu-files dashboard-addpanel'>
                    $get_included_files
                </ul>
                <ul class='dropdown-menu-errors dashboard-addpanel'>
                    $error_html
                </ul>
                <ul class='dropdown-menusql dashboard-addpanel'>      
                   $query_html
                </ul>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <b class='navbar-brand'>Devolper </b>
                        <p class='navbar-text navbar-right'> {$html_info} </p>
                    </div>
                    
                    <ul class='nav navbar-nav navbar-right'>
                        <li><a class='hiden_border' href='#'>скрыть</a></li>
                        <li class='dropdown'>
                          <a href='#' class='dropdown-files'>Files <span class='caret'></span></a> 
                        </li>
                        <li class='dropdown'>
                          <a href='#' class='dropdown-errors'>Errors <span class='caret'></span></a> 
                        </li>
                        <li class='dropdown'>
                          <a href='#' class='dropdown-sql'>SQL <span class='caret'></span></a> 
                        </li>
                        
                    </ul>
                </div>
            </nav>
            <script>
                
                $('.hiden_border').on('click', function(){ $(this).parent().parent().parent().parent().hide(); });
                $('.dropdown>.dropdown-sql').on('click', function(e){ $('.dropdown-menusql').toggle(0, hiden_info_block(e)); });
                $('.dropdown>.dropdown-errors').on('click', function(e){ $('.dropdown-menu-errors').toggle(0, hiden_info_block(e)); });
                $('.dropdown>.dropdown-files').on('click', function(e){ $('.dropdown-menu-files').toggle(0, hiden_info_block(e)); });
                
                
                function hiden_info_block(e) {
                    if($(e.target).hasClass('dropdown-sql')){
                        $('.dropdown-menu-errors').hide();
                    }else if($(e.target).hasClass('dropdown-errors')){
                        $('.dropdown-menusql').hide();
                    }else if(){
                        
                    }
                }
            </script>
            ";
        }
        echo $html;
    }
    //Отлавливаем ошибки:    /////////////////////////////////
    public static function ErrorHandler($errno, $errstr, $errfile, $errline)
    {
        if (!(error_reporting() & $errno)) {
            // This error code is not included in error_reporting, so let it fall
            // through to the standard PHP error handler
            return false;
        }
        switch ($errno) {
            case E_USER_ERROR:
                self::$errors[] = "<b>ERROR</b> [Файл: [$errfile] строка: [$errline] символ: [$errstr]<br />\n";
            case E_USER_WARNING:
                self::$errors[] = "<b>WARNING</b> Файл: [$errfile] строка: [$errline] символ: [$errstr]<br />\n";
                break;

            case E_USER_NOTICE:
            case 8:
                self::$errors[] = "<b>NOTICE</b> Файл: [$errfile] строка: [$errline] символ: [$errstr]<br />\n";
                break;

            default:
                self::$errors[] = "<b>Нейзвестный тип ошибки</b>: [$errno]  Файл: [$errfile] строка: [$errline] символ: [$errstr]<br />\n\";<br />\n";
                break;
        }

        /* Don't execute PHP internal error handler */

        return true;
    }

    public static function add_error($text, $file, $line){
        self::$errors[] = "<b>ERROR</b> [Файл: [$file] строка: [$line] описание: [$text]<br />\n";
    }
    ///////////////////////////////////////////////////////////

}


