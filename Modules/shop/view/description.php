<?php
/**: Релиз завершен
 * Created by PhpStorm.
 * User: bootta
 * Date: 26.12.16
 * Time: 13:44
 */

use Module\shop\Model\Products;
$res = Products::getproduct(Info::getUri('3')->only());

/*echo '<pre>';
print_r($res);
echo '</pre>';*/
//session_destroy();

/*echo '<pre>';
print_r($_SESSION);
echo '</pre>';*/
?>

<div class="row description">
    {% ACART %}
    <h2><?=$res['name'] ?></h2><hr />
    <div class="col-lg-4">
        <img class="img-responsive ashopimg" src="{% SITE %}/img/shop/<?=$res['img'] ?>" alt="<?=$res['name'] ?>">
    </div>
    <div class="col-lg-4">
        <span class="ashopinfo">
            <ul style="list-style: none; padding: 0px;">
                <li>Цена: <b><?=$res['price'] ?></b> руб.</li>
                <li>Призводитель: <?=$res['Manufacturer'] ?></li>
            </ul>
        </span>
        <div class="description-block">
            <?=$res['description']?>
        </div>
    </div>
    <div class="col-lg-4">
        <span class="">
            <a href="{% SITE %}/shop/action/bay/<?=$res['id_product'] ?>" class="btn btn-primary btn-block">Добавить в корзину</a>
            <hr />
            <a href="#" onclick="history.go(-1);" class="btn btn-info btn-block"> < Назад</a>
        </span>
    </div>
</div>

