<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 26.03.2017
 * Time: 18:52
 */

use Module\vk\api\method_vk as send_vk;

$owner_id = [
    '-143232626',
    '-143210526',
];


//Инициализируем класс
$vk = new send_vk();

$paramsAlbums = [
    "owner_id" => $owner_id,
    "extended" => 1,
    "photo_sizes" => 0,
    "no_service_albums" => 0,
    "need_hidden" => 0,
    "skip_hidden" => 0,
    "v" => '5.63'
];
$getAlbum = $vk->method('photos.getAlbums', $paramsAlbums);

$params = array(
    "owner_id" => $owner_id,
    "extended" => 1,
    "photo_sizes" => 0,
    "no_service_albums" => 0,
    "need_hidden" => 0,
    "skip_hidden" => 0,
    "v" => '5.63'
);
$post = $vk->method("photos.getAll", $params);
/*echo '<pre>';
print_r($post);
echo '</pre>';
die();*/
//Получаем все альбомы с названием auto_vk
$checkIdAlbums = [];

foreach ($getAlbum as $k=>$r){

    foreach ($r['response']['items'] as $album){
        if($album['title'] == 'auto_vk'){
            $checkIdAlbums[] = $album['id'];
        }
    }
}
?>
{% MENU %}




<div class="container">
    <h2>VK <small>public</small></h2><hr />

    <ul class="list-group col-lg-12">
        <?php foreach ($post as $response):?>
            <?php foreach ($response['response']['items'] as $items):
                if(!in_array($items['album_id'], $checkIdAlbums)) continue;
            ?>


                <li class="list-group-item"><a id="<?=$items['id']?>" href='#'><img src="<?=$items['photo_75'];?>" alt="<?=$items['text'] ?>"></a></li>
            <?php endforeach;?>
        <?php endforeach;?>
    </ul>
    <section class="col-lg-10">
        <iframe src="https://vk.com/club143232626">

        </iframe>
    </section>

    <script src="https://vk.com/js/api/openapi.js?142" type="text/javascript"></script>
    <div id="vk_community_messages"></div>
    <script type="text/javascript">
        VK.Widgets.CommunityMessages("vk_community_messages", 143554091);
    </script>
</div>