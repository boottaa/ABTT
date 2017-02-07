<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 23.12.16
 * Time: 17:17
 */

use Module\shop\Model\Products;
echo '<pre>';
print_r($_POST);
echo '<hr /></pre>';

$data['name']          = filter_input(INPUT_POST, 'name');
$data['Manufacturer']  = filter_input(INPUT_POST, 'Manufacturer');
$data['description']   = filter_input(INPUT_POST, 'description');
$data['price']         = filter_input(INPUT_POST, 'price');

$uploaddir = Info::get('root_dir').'/Modules/shop/img/';
$fileIMG = basename($_FILES['image']['name']);
$uploadfile = $uploaddir.$fileIMG;


if(file_exists($uploadfile)){
    $x = 0;
    file:
        $x = $x+1;
        $fileIMGname = $x.'_'.$fileIMG;
        @$meme = end(explode('.', $fileIMGname));
        $fileIMGname = md5($fileIMGname).'.'.$meme;
        $uploadfile = $uploaddir.$fileIMGname;

        if(file_exists($uploadfile)){
            goto file;
        }
}

$data['img'] = $fileIMGname;

if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
    Products::addproduct($data);
    echo 'Данные сохранены';
    echo '<script>window.location.href = "{% SITE %}/admin/shop/shop_add";</script>';
} else {
    exit('Ошибка при сохранение данных');
}

