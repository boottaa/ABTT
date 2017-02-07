<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 28.12.16
 * Time: 11:30
 */

?>
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Пожалуйста введите e-mail и пароль</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="{% SITE %}/admin/action/login">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Пароль" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Войти</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
