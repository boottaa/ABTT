<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$getquery = empty($_GET['query'])?$_GET['query'] = '': $_GET['query']= $_GET['query'];
$que = urlencode($getquery);
//$simple = file_get_contents("https://ru.wikipedia.org/w/api.php?action=opensearch&search={$que}&prop=info&format=xml&inprop=url");
$simple = file_get_contents("http://speller.yandex.net/services/spellservice/checkText?text={$que}");


$movies = new SimpleXMLElement($simple);

echo '<pre>';
if(!empty($movies->error)){
    foreach($movies->error as $val){
        $ser[] = $val->word;
        $rep[] = $val->s[0];
    }
    $res = str_replace($ser, $rep, $getquery);
}else{
    $res = $getquery;
}
echo $res;
echo '</pre>';
?>

