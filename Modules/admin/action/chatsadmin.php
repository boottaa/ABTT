<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 30.12.16
 * Time: 10:35
 */
?>

<?php
$dir = dirname(__DIR__).'/chat/';

$r = scandir($dir);
$json = array();
unset($r[array_search('.', $r)]);
unset($r[array_search('..', $r)]);
if(count($r)<=0){
    return;
}
foreach ($r as $k=>$v){
    $sessionid[] =  explode('.', $v)[0];
    $res[] = file_get_contents($dir.$v);
}
//if(count($res)<1){ echo 'Нет открытых чат комнат';  }
foreach ($res as $keym => $messages):
    if(empty($messages)){
        continue;
    }
    $mess = explode(PHP_EOL, $messages);

    $json[$sessionid[$keym]] = $mess;
endforeach;

echo json_encode($json);


?>