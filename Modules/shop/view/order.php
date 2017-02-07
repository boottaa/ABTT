<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 27.12.16
 * Time: 14:55
 */
?>



<h2> Оформления заявки </h2><hr /><br />
<form method="post" action="{% SITE %}/shop/action/order">
    <div class="form-group">
        <label for="Name">Имя: </label>
        <input type="text" class="form-control" name="Name" id="Name" placeholder="Введите пожалуйста ваше имя">
    </div>
    <div class="form-group">
        <label for="Email">Email: </label>
        <input type="email" class="form-control" name="Email" id="Email" placeholder="Введите пожалуйста ваш Email">
    </div>
    <div class="form-group">
        <label for="Phone">Телефон: </label>
        <input type="text" class="form-control" name="Phone" id="Phone" placeholder="Введите пожалуйста ваш номер телефона">
    </div>
    <div class="form-group">
        <label for="Address">Адрес: </label>
        <input type="text" class="form-control" name="Address" id="Address" placeholder="Введите пожалуйста ваш адрес">
    </div>

    <div class="checkbox">
        <label>
            <input type="hidden" name="Subscribe_to_Newsletter" value="0">
            <input type="checkbox" value="1" name="Subscribe_to_Newsletter" checked="checked"> Подписать на рассылку <i>(скидки и акции)</i>
        </label>
    </div>
    <hr />
    <p>
        Оплата товара производится при получение товара.
    </p>
    <br />
    <button type="submit" class="btn btn-default">Отправить</button>
</form>