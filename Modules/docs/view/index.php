<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 28.01.2017
 * Time: 21:08
 */
use Module\docs\Controller\GetDocs;

/*echo '<pre>';
print_r((new GetDocs())->docs_all());
echo '</pre>';*/

?>
{% MENU %}

<style>
    .nav>li>ul>li>a{
        padding-left: 30px;
    }
    li.active .active{
        background: none !important;
    }

    #bs-docs-sidebar .active{
        background: #c7ddef;
    }
</style>

{% DOCS:MENU %}



<div class="col-md-9 myDocs" style="margin-bottom: 200px;">
    <section id="config" >
        <h3 style="color: #787878;">Настройка (config)</h3><hr /><br />
        <p>
            Основные найтройки Framework осущевстляются в файле "<i>config.php</i>"
        </p>
        <table class="table">
            <tr>
                <th>Название блока</th>
                <th>Описание</th>
            </tr>
            <tr>
                <td>
                    base
                </td>
                <td>Основная информация о сайте:
                    <ul>
                        <li>site - Доменное имя сайта</li>
                        <li>root-dir - Корневая дериктория веб приложения</li>
                        <li>template - Шаблон который будет подключен по умолчанию</li>
                        <li>devolper - Режим разработчика (true/false)</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>
                    database
                </td>
                <td>
                    Содержит информацию о подключаемых серверов БД. Может содержать следующие данные:
                    <ul>
                        <li>
                            DB_SERV - Имя хоста или IP для подключения к mysql серверу
                        </li>
                        <li>
                            DB_USER - Пользователь для подключения к mysql серверу
                        </li>
                        <li>
                            DB_PASS - Пароль для подключения к mysql серверу
                        </li>
                        <li>
                            DB_PRIFIX - Прификс к бд может быть указан для разделения бд относящихся к одному приложению. (Пример прификса dbf: dbf.mydatabase, dbf.usersdb )
                        </li>
                        <li>
                            DB_NAME - Указываем все бд на указанном сервере которое будет использовать веб приложения. Это сделано для безопасности и возможности сразу (в коде) увидеть какие бд использует веб приложения.
                        </li>
                    </ul>
                </td>
            </tr>

            <!--
            <tr>
                <td>

                </td>
                <td>

                </td>
            </tr>
            -->
        </table><hr />
    </section>
    <section id="Info">
        <h3 style="color: #787878;">Info</h3><hr />
        <p>
            Класс отвечающий за получения данных о сайте и передачи их в модули.
            Так же данный класс получает информацию об URL для обеспечения маршрутизации внутри модуля.
        </p>
        <table class="table">
            <tr>
                <th>Название метода</th>
                <th>Описание</th>
            </tr>
            <tr>
                <td>
                    (private static) $config
                </td>
                <td>
                    Свойства в которое записываются все конфигурационные данные.
                </td>
            </tr>
            <tr>
                <td>
                    (private static) getconfig
                </td>
                <td>
                    Данное свойства получает и записывает все данные в метод $config;
                </td>
            </tr>
            <tr>
                <td>

                    (public static) get -$val -$type
                </td>
                <td>
                    Данное свойства возвращает массив или строку полученного параметра из файла <a href="#config">config</a>. Где $val - обязательное значения свойства.
                    А $type - блок из которго будут приняты значения (по умолчанию base).
                </td>
            </tr>
            <tr>
                <td>
                    (public static) get_db -$param -$name
                </td>
                <td>
                    Данное свойства возвращает строку полученного параметра из файла <a href="#config">config</a> блок database. Где $param - значения свойства.
                    А $name - блок (название сервера) с которго будут приняты значения (по умолчанию данные тянутся из блока default)
                    если не задан параметр $name - Получает данные из блока 'default'.
                </td>
            </tr>
        </table><hr />
    </section>
    <section id="Connect">
        <h3  style="color: #787878;">Connect</h3><hr />
        <p>
            Класс Connect  - класс для подключения к бд, внутренний класс ядра ABTT используется только в классе <a href="#SQL">SQL</a>
        </p>
        <table class="table">
            <tr>
                <th>Название метода</th>
                <th>Описание</th>
            </tr>
            <tr>
                <td>
                    (protected static) _connect
                </td>
                <td>
                    Метод проверяющий создан ли обект класса соединения с бд и создающий объект класса в случае если его нет.
                    Однако: если использован <a href="#set_adapter">SQL::set_adapter </a> обект класса создается повторно.
                </td>
            </tr>
        </table><hr />
        
    </section>
    <section id="Dashboard">
        <h3  style="color: #787878;">Dashboard</h3><hr />
        <p>
            Класс Dashboard отвечает за вывод информации и перехват ошибок приложения, так же данный класс выводит панель разработчика,
            время и количество затраченых мб на работу приложения.
        </p>
    </section>
</div>

<script>

    $(document).ready(function() {
        $(".bs-docs-sidenav").metisMenu({
            // auto collapse.
            toggle: true,
            // prevents or allows dropdowns' onclick events after expanding/collapsing.
            preventDefault: true,
            // CSS classes
            activeClass: 'active',
            collapseClass: 'collapse',
            collapseInClass: 'in',
            collapsingClass: 'collapsing',
            onTransitionStart: false,
            onTransitionEnd: false
        });

        $('[data-spy="scroll"]').each(function () {
            var $spy = $(this).scrollspy('refresh');
        });
        $(document).on('activate.bs.scrollspy', function () {
            console.log($('.collapse.in').parent().find('a').attr('href'));
            $('.collapse.in').parent().removeClass('active');
        });
    });
</script>
