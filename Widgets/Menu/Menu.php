<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 23.12.16
 * Time: 10:34
 */
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project-Alfa</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{% SITE %}">Главное</a></li>
                <li><a href="{% SITE %}/index/projects">Наши проекты</a></li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Что ищем?">
                </div>
                <button type="submit" class="btn btn-default">Найти</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Авторизация <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Войти</a></li>
                        <li><a href="#">Регистрация</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Забыл пароль</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>