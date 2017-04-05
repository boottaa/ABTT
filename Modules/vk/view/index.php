<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 22.12.16
 * Time: 11:04
 */

use Module\vk\api\method_vk as send_vk;


$access_token = "63e61028e7c0cbbfc1fdca60958bf7882731fb7e09d2fed32b2813387fbf18fee0dfb9e720783b6795af9";
//$owner_id = "-143232626"; // Не забудь добавить - перед ID! //ID ГРУПП

$owner_id = [
    143232626,
    143210526,
];



//Инициализируем класс
$vk = new send_vk($access_token);

$params = array(
    "owner_id" => $owner_id,
    "from_group" => 1,
    "message" => $_GET['message'],
    "attachments" => $_GET['attachments']
);
$post = $vk->method("wall.post", $params);
echo '<pre>';
print_r($post);
echo '</pre>';
die();


$endpoint = 'https://oauth.vk.com/authorize?client_id=5940763&display=page&scope=mail,photos&response_type=token&v=5.63&state=offline';

// Use one of the parameter configurations listed at the top of the post

/*
 *
 * attachments=photo-143232626_456239017
{
"response": {
"count": 1,
"items": [{
"id": 456239017,
"album_id": 243276056,
"owner_id": -143232626,
"user_id": 25785035,
"photo_75": "https://pp.userap...8f2/dGBCuZPVIq0.jpg",
"photo_130": "https://pp.userap...8f3/0lV2LCr7Wu8.jpg",
"photo_604": "https://pp.userap...8f4/6HOWSCVJJZc.jpg",
"photo_807": "https://pp.userap...8f5/gCPwkkLnv2s.jpg",
"width": 700,
"height": 438,
"text": "",
"date": 1490540596
}]
}
}
die();*/
?>


<div class="container">
    <h2>VK <small>public</small></h2><hr />
    <p>
        hello world

    </p>
</div>
