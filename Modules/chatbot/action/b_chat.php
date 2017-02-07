<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 08.01.2017
 * Time: 16:33
 */

use Module\chatbot\Controller\Logick as Chatbot;
$sessionid   = $_POST['sessionid'];
$action      = filter_input(INPUT_POST, 'action');
$role        = filter_input(INPUT_POST, 'role');
$check       = filter_input(INPUT_POST, 'check');
$message     = trim(filter_input(INPUT_POST, 'message'));
$deletedFile = filter_input(INPUT_POST, 'deleted');
require_once 'cleanText.php';

$dir = dirname(__DIR__).'/chats/';
$json = array();

if($check == 1):
    getchat:
    if($role == 'Client' && $action == 'getchat'){
        $clientfile = $dir.$sessionid[0].'.txt';
        //echo $clientfile;
        if (file_exists($clientfile)){
            $res[] = file_get_contents($clientfile);
        }else{
            $res[] = 'ChatBot :||: '.date("H:i:s").' :||: Добрый день! Чем я могу вам помочь?'.PHP_EOL;
        }

    }elseif ($action == 'save' && !empty($message)){

        $filesave = $dir.$sessionid[0].'.txt';

        if (file_exists($filesave)){
            $txt = NULL;
        }else{
            $txt = 'ChatBot :||: '.date("H:i:s").' :||: Добрый день! Чем я могу вам помочь?'.PHP_EOL;
        }
        //Здесь получаем так же как передается в бд
        $clear_message = cleanText($message);


        $txtAnswer = Chatbot::sendAnswer($clear_message);

        $key_id = empty($txtAnswer[0]['id_keyword'])?'0': $txtAnswer[0]['id_keyword'];

        Chatbot::addUserAnswer($key_id, $clear_message, $message);
        print_r($txtAnswer);
        if(empty($txtAnswer[0])){
            $getAnswer['text'] = 'Я тебя не понимаю, объясни пожалуйста?';
        }else{
            $getAnswer = Chatbot::getAnswer( $txtAnswer[0]['id_answer'], $txtAnswer[0]['id_category'] );
        }
        /*echo '<pre>';
        print_r($txtAnswer);
        echo '</pre>';*/


        //Сюда пишем ответ по доработе
        $getAnswer = 'ChatBot :||: '.date("H:i:s").' :||: '.$getAnswer['text'].PHP_EOL;

        file_put_contents( $filesave, $txt.$role.' :||: '.date("H:i:s").' :||: '.$message.PHP_EOL.$getAnswer, FILE_APPEND | LOCK_EX );
        $action = 'getchat';
        goto getchat;
    }else{
        goto error;
    }

    //if(count($res)<1){ echo 'Нет открытых чат комнат';  }
    foreach ($res as $keym => $messages):
        if(empty($messages)){
            continue;
        }
        $mess = explode(PHP_EOL, $messages);

        $json[$sessionid[$keym]] = $mess;
    endforeach;
else:

    error:
    $json = array(
        'error' => 1,
        'result' => 'Ошибка в передечи данных'
    );
endif;
echo json_encode($json);