<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 03.01.2017
 * Time: 15:58
 */

$sessionid = empty($_POST['sessionid'])?'':$_POST['sessionid'];

$action     = filter_input(INPUT_POST, 'action');
$role       = filter_input(INPUT_POST, 'role');
$check      = filter_input(INPUT_POST, 'check');
$message   = filter_input(INPUT_POST, 'message');
$deletedFile = filter_input(INPUT_POST, 'deleted');


$dir = dirname(__DIR__).'/chat/';
$json = array();

if($check == 1):
getchat:
    if($role == 'Admin' && $action == 'getchat'){
        $r = scandir($dir);

        unset($r[array_search('.', $r)]);
        unset($r[array_search('..', $r)]);
        unset($sessionid);
        if(count($r)<=0){
            return;
        }
        foreach ($r as $k=>$v){
            $sessionid[] = explode('.', $v)[0];
            $res[] = file_get_contents($dir.$v);
        }
    }elseif($role == 'Client' && $action == 'getchat'){
        $clientfile = $dir.$sessionid[0].'.txt';
        //echo $clientfile;
        if (file_exists($clientfile)){
            $res[] = file_get_contents($clientfile);
        }else{
            $res[] = 'Admin :||: '.date("H:i:s").' :||: Добрый день! Чем я могу вам помочь?'.PHP_EOL;
        }

    }elseif ($action == 'save' && !empty($message)){

        $filesave = $dir.$sessionid[0].'.txt';

        if (file_exists($filesave)){
            $txt = NULL;
        }else{
            $txt = 'Admin :||: '.date("H:i:s").' :||: Добрый день! Чем я могу вам помочь?'.PHP_EOL;
        }
        file_put_contents( $filesave, $txt.$role.' :||: '.date("H:i:s").' :||: '.$message.PHP_EOL, FILE_APPEND | LOCK_EX );
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