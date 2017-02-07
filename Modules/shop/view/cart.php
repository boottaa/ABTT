<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 26.12.16
 * Time: 16:17
 */
@$products = $_SESSION[$sesionid]['cart']['products'];
?>
<h2>Корзина: </h2><hr />
<?php if(count($products)<1):?>
<h4>Корзина пустая</h4>
    <br /><br /><br />
    <a href="{% SITE %}/shop" onclick="history.go(-1);" class="btn btn-info btn-block"> < Назад</a>
<?php else: ?>
<?php foreach ($products as $k=>$v): ?>
<div class="row">
    <input type="hidden" name="id_products" class="id_products" value="<?=$k; ?>">
    <div class="col-lg-1">
        <img class="img-responsive ashopimgcart" src="{% SITE %}/img/shop/<?=$v['img'] ?>" alt="<?=$res['name'] ?>">
    </div>
    <div class="col-lg-3">
        <a href="{% SITE %}/shop/description/<?=$k ?>"><h4><?=$v['name'] ?></h4></a>
    </div>
    <div class="col-lg-offset-3 col-lg-3">
        <p>Цена за штуку: <?=$v['price'] ?> руб.</p>
        <p>Количество: <?=$v['count'] ?> </p>
    </div>
    <div class="col-lg-1">
        <a href="#" class="btn btn-default btn-block btncart cart_bay_up">&#9652;</a>
        <a href="#" class="btn btn-default btn-block btncart cart_bay_down">&#9662;</a>
    </div>
    <div class="col-lg-1">
        <a href="#" class="btn btn-default btn-block btncart cart_bay_cancel">&#10005;</a>

    </div>

</div><hr />
<?php endforeach;  ?>
<div class="row">
    <div class="col-lg-10">
        <a href="{% SITE %}/shop/order" class="btn btn-success btn-block">Оформить заказа</a>
    </div>
    <div class="col-lg-2">
        <a href="{% SITE %}/shop" onclick="history.go(-1);" class="btn btn-info btn-block"> < Назад</a>
    </div>
</div>
<?php endif; ?>
