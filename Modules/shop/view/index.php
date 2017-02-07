<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 23.12.16
 * Time: 14:04
 */
use Module\shop\Model\Products;
$res = Products::getproduct();
?>
{% ACART %}
<h1>shop on</h1>
<hr />
<br />

<?php foreach ($res as $v): ?>
<div class="panel panel-info col-lg-3">
    <div class="panel-body">
        <input type="hidden" name="id_product" value="<?=$v['id_product'] ?>">
        <h4><?=$v['name'] ?></h4><hr />
        <center><img class="img-responsive ashopimg" src="{% SITE %}/img/shop/<?=$v['img'] ?>" alt="<?=$v['name'] ?>"></center>
        <span class="ashopinfo">
            <ul style="list-style: none; padding: 0px;">
                <li>Цена: <b><?=$v['price'] ?></b> руб.</li>
                <li>Призводитель: <?=$v['Manufacturer'] ?></li>
            </ul>
        </span>
        <span class="btnashop">
            <a href="{% SITE %}/shop/action/bay/<?=$v['id_product'] ?>" class="btn btn-success">Купить</a>
            <a href="{% SITE %}/shop/description/<?=$v['id_product'] ?>" class="btn btn-default pull-right">Подробнее</a>
        </span>
    </div>
</div>
<?php endforeach; ?>
<div class="row">

    <div class="col-lg-12" style="padding-top: 20px; padding-bottom: 20px">
        <hr /><br />
        Демонстрация Alfa-Shop
    </div>
    <br /><br /><br />
</div>