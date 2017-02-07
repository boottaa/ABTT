<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 28.01.2017
 * Time: 18:01
 */

?>
{% ADMIN:MENU %}
<div id="page-wrapper">
    <div class="row">
        <h2>Admin <small>добавления товара в магазин</small></h2><hr />
    </div>
    <div class="row">
        <form  enctype="multipart/form-data" class="col-lg-6" action="{% SITE %}/admin/action/shop/saveproducts" method="post">
            <div class="form-group">
                <label for="name">Название продукта: </label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Название">
            </div>
            <div class="form-group">
                <label for="Manufacturer">Страна производитель: </label>
                <input type="text" class="form-control" id="Manufacturer" name="Manufacturer" placeholder="Страна">
            </div>
            <div class="form-group">
                <label for="price">Цена: </label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Цена">
            </div>
            <div class="form-group">
                <label for="description">Описание: </label><br />
                <textarea id="description" name="description" style="width: 100%; resize: vertical;"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Выберете изоброжения</label>
                <input type="file" name="image" accept="image/*" id="exampleInputFile">
                <p class="help-block">Все поля обязательный для заполнения.</p>
            </div>

            <button type="submit" class="btn btn-default">Сохранить</button>
        </form>
    </div>
</div>

