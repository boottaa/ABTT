<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 07.01.2017
 * Time: 16:11
 *
 *
 *
 * Настройка для mysql: https://dev.mysql.com/doc/refman/5.5/en/fulltext-fine-tuning.html
 * Потом не забыть: REPAIR TABLE "имя таблицы" QUICK;
 */



/*

  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  // ТЕСТ Данного файла
  $getquery = empty($_GET['query'])?$_GET['query'] = '': $_GET['query']= $_GET['query'];
  echo '<pre>';
  print_r(cleanText($getquery));
  echo '</pre>';

*/




function cleanText($getquery){
    //Переводим весь текст в нижней ригистр
    $text = mb_strtolower($getquery);
    //Слова паразиты
    $serch = [
        'короче', 'типа', 'ну', 'собственно', 'также', 'тоже', 'так',
        'и', 'или', 'зато', 'ладно', 'хотя', 'возможно', ' ', ''
    ];
    //Проверяем текст на ошибки
    $textCheck = CheckGrammar($text);
    //Разбираем стороку
    $txtArray = explode(' ', $textCheck);
    //убираем слова паразиты в провереном тексте
    $e = array_diff($txtArray, $serch);
    //Убираем окончание в словах
    endRemove($e);
    //  Возвращем результат
    return $e;
}
//После чего разбиваем текст
function CheckGrammar($txt){
    $tex = urlencode($txt);
    /*
    Проверка текста по средствам YANDEX spellservice
    Отпровляем текст на сервер yandex. Получаем ответ, если есть слова которые нужно заменить, меняем их.
    */
    $simple = file_get_contents("http://speller.yandex.net/services/spellservice/checkText?leng=ru&text={$tex}");
    $movies = new SimpleXMLElement($simple);

    //(также убираем запятые, союзы и точки) и составные слова паразиты из двух и более слов
    $serch = ['.', ',', '!', '?', ';', '"', '\'', '(', ')'];
    $replase = ['', '', '','','', '','', '', ''];
    if(!empty($movies->error)){
        foreach($movies->error as $val){
            //echo '1<hr />';
            $serch[] = $val->word;
            $replase[] = $val->s[0];
        }
    }

    $aarr =[
        ' ну это ', ' вроде бы ', ' как бы ', ' как сказать ', ' в общем-то ', ' то есть ', ' на самом деле ', ' так же ', ' то же '
    ];

    $res = str_replace($aarr, ' ', str_replace($serch, $replase, $txt));

    return $res;
}

//Убираем окнчание:
function endRemove(&$arr){
    $search = '';
    foreach ($arr as $val){
        $okonchaniya = "/(ый|ой|ая|ое|ые|ому|а|о|у|ы|у|ю|ёй|ём|ом|ем|е|ого|ему|и|ство|ых|ох|ия|ий|ь|я|он|ют|ат)$/i";
        $search[] = preg_replace($okonchaniya,'*',$val);
    }
    $arr = $search;
}
