<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 28.01.2017
 * Time: 21:08
 */
use Module\docs\Controller\GetDocs;
Template::set_title('Документация');
Template::set_tmp(true);
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
                <td id="config::database">
                    Содержит информацию о подключаемых серверов БД. Могут быть прописанны сразу несколько серверов для подключения.
                    Содержит следующие данные:
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
            Класс Dashboard отвечает за вывод информации и перехват ошибок приложения, вывод SQL запросов, так же данный класс выводит панель разработчика,
            время и количество затраченых мб на работу приложения.
        </p>
        <table class="table">
            <tr>
                <th>Название метода</th>
                <th>Описание</th>
            </tr>
            <tr>
                <td>
                    (public static) start
                </td>
                <td>
                    Метод инцелизирует начала сбора информации о приложение (о потребляемой памяти и времени);
                </td>
            </tr>
            <tr>
                <td>
                    (public static) end
                </td>
                <td>
                    Метод завершает сбор информации и подсчитывает собронные данные, для вывода их в Dashboard
                </td>
            </tr>
            <tr>
                <td>
                    (public static) view_statistics
                </td>
                <td>
                    Метод завершает сбор информации и подсчитывает собронные данные, для вывода их в Dashboard
                </td>
            </tr>
            <tr>
                <td>
                    (public static) ErrorHandler
                </td>
                <td>
                    Метод используется для получения информации об ошибки и вывода ее в панель Devolper. Данный метод испльзуется во входном файле ( /Public/index.php ): set_error_handler("Dashboard::ErrorHandler");
                </td>
            </tr>

        </table><hr />
    </section><br /><br />
    <section id="Template">
        <h3  style="color: #787878;">Template</h3><hr />
        <p>
            Класс Template обеспечивает шаблонизацию всего проекта, так же через данный класс возможно изменить шабон (подключить другой) для конкретного модуля или отключить шаблонизацию для модуля.
            Так же данный класс заменяет спец теги, позволяет подключить (js, css) скрипты для конкретного модуля.
        </p>
        <table class="table">
            <tr>
                <th>Название свойства</th>
                <th>Описание</th>
            </tr>
            <tr>
                <td>
                    (protected static) $styles
                </td>
                <td>
                    Свойства в котором хранятся все ссылки на "css" подключаемые файлы.
                </td>
            </tr>
            <tr>
                <td>
                    (protected static) $scripts
                </td>
                <td>
                    Свойства в котором хранятся все ссылки на "javascript" подключаемые файлы.
                </td>
            </tr>
            <tr>
                <td>
                    (protected static) $str
                </td>
                <td>
                    Свойства в котором хранятся все ссылки на "javascript" подключаемые файлы.
                </td>
            </tr>
            <tr>
                <td>
                    (protected static) $title
                </td>
                <td>
                    Свойства в котором хранятся данные о загаловке странице путем замены '{% TITLE %}' на указанный заголовок. Методам
                    <a href="#Template::set_title"> Template::set_title() </a> можно задать название любой страницы прям в шаблоне.
                </td>
            </tr>
            <tr>
                <td>
                    (protected static) $tmp
                </td>
                <td>
                    Свойства в котором хранятся данные о подключаемом шаблоне. Методам
                    <a href="#Template::set_tmp"> Template::set_tmp() </a> можно задать шаблоне как в
                    <a href="#Module::conf.php">conf.php</a> (конфигурационный файл модуля) так и в самом предсталение.
                </td>
            </tr>
        </table>

        <table class="table">
            <tr>
                <th>Название метода</th>
                <th>Описание</th>
            </tr>
            <tr>
                <td id="Template::addTeg">
                    (public static) addTeg -$teg -$replase
                </td>
                <td>
                    Метод добавляет тег который будет заменен в проццеси работы приложения, теги желательно прописывать в фигрных скобках - {% YOU_TEG %},
                    Где YOU_TEG имя вашего тега.
                    <ul>
                        <li>$teg - имя тега который нужно заменить</li>
                        <li>$replase - указываем на что заменяем</li>
                    </ul>
                    Пример добавления тега корзина: Template::addTeg('{% TEG_CART %}', 'КОРЗИНА'). <br />
                    В данном примере все теги '{% TEG_CART %}' будут заменены словам 'КОРЗИНА'.
                </td>
            </tr>
            <tr>
                <td>
                    (public static) addScript -$script
                </td>
                <td>
                    Метод подключает JavaScript.

                    <ul>
                        <li>$script - Указывает название скрипта</li>
                    </ul>
                    Пример добавление скрипта из шаблона (Templates):
                    <br />
                    Template::addScript('you_script.js');<br />
                    Где "you_script.js" имя скрипта в папке "Template/default/script". <a href="#create::Template">О создание шаблона читайте тут</a>
                    <br /><br />
                    Добавление скрипта из Модуля: <br />
                    Template::addScript('mod_name/you_script.js'); <br />
                    Где "mod_name" имя модуля а "you_script.js" имя файла.<br />
                    <b>Внимание: </b> скрипт должен находиться в дериктории "/Template/имя_модуля/script/имя_скрипта.js"
                </td>
            </tr>
            <tr>
                <td>
                    (public static) addStyle -$style
                </td>
                <td>
                    Метод подключает CSS.
                    <ul>
                        <li>$style - Указывает название css файла</li>
                    </ul>
                    Пример добавление css файла из шаблона ( Templates ):
                    <br />
                    Template::addStyle('you_style.css');<br />
                    Где "you_style.css" имя скрипта в папке "Template/default/style". <a href="#create::Template">О создание шаблона читайте тут</a>
                    <br /><br />
                    Добавление скрипта из Модуля: <br />
                    Template::addStyle('mod_name/you_style.css'); <br />
                    Где "mod_name" имя модуля а "you_style.css" имя файла.<br />
                    <b>Внимание: </b> скрипт должен находиться в дериктории "/Template/имя_модуля/style/имя_стиля.css"
                </td>
            </tr>
            <tr>
                <td>
                    (public static) set_title -$name
                </td>
                <td>
                    Метод указывает имя страницы в тегах <?= htmlspecialchars('<title>') ?>, можно указать как в шаблрне модуля так и для модуля целиком указав в config.php <a href="#create::Modul">подробнее о создание модуля читайти тут</a>
                    <ul>
                        <li>$name - имя страницы которое будет прописано в <?= htmlspecialchars('<title>') ?></li>
                    </ul>
                    Пример указания заголовка 'Новая страница': Template::set_title('Новая страница').
                </td>
            </tr>
            <tr>
                <td>
                    (public static) set_tmp -$tmp
                </td>
                <td>
                    Метод указывает имя шаблона или отключает его полностью если передать булево значения false, можно указать как в шаблрне модуля так и для модуля целиком (если для вашего модуля нужна другая шаблонизация или хотите отключить ее) указав в config.php <a href="#create::Modul">подробнее о создание модуля читайти тут</a>
                    <ul>
                        <li>$tmp - имя шаблона который будет выбран</li>
                    </ul>
                    Пример отключения шаблона: Template::set_tmp(false).
                </td>
            </tr>
        </table><hr />
    </section>

    <section id="Rout" >
        <h3 style="color: #787878;">Rout</h3><hr />
        <p id="Routing::navigation">
            Основной класс отвечающей за навигацию подключения файлов и опрделения типов файлов.
        </p>
        <table class="table">
            <tr>
                <th>Название своства</th>
                <th>Описание</th>
            </tr>
            <tr>
                <td>
                    (private static) <br />$isimg = false </td>
                <td>
                    Определяет тип файл, если изображения то подгружаем другим способам использовав функцию
                    "fpassthru" а не обычное подключение 'include'.
                </td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <th>Название метода</th>
                <th>Описание</th>
            </tr>
            <tr>
                <td>
                    ( public static ) on -$dir </td>
                <td>
                    Метод отвечает за построничную навигацию внутри модуля если подулючить данный метод в любом модуле,
                    то при обращение к модулю будет поключен файл index.php из деректории view. (/Modules/имя_модуля/view/index.php)<br />
                    <a href="#Routing::navigation">Подробнее о навигации тут</a>
                </td>
            </tr>
            <tr>
                <td>
                    ( public static ) int </td>
                <td>
                    Метод евляется входной точкой в инцелизации проекта,
                    запускает шаблонизацию и отвечает за маршрутизацию во всем проекте.
                    Так же метод подключает спец теги
                    <a href="#Template::addTeg"> (подробнее о тегах тут) </a>
                    <a href="#Routing::navigation">Подробнее о навигации тут</a>
                </td>
            </tr>
            <tr>
                <td>
                    ( private static ) tegs -$content
                </td>
                <td>
                    Метод отвечает за построничную навигацию внутри модуля если подулючить данный метод в любом модуле,
                    то при обращение к модулю будет поключен файл index.php из деректории view. (/Modules/имя_модуля/view/index.php)<br />
                    <a href="#Routing::navigation">Подробнее о навигации тут</a>
                </td>
            </tr>
            <tr>
                <td>
                    ( private static ) routing
                </td>
                <td>
                    Отвечает за определения типа файла подгрузку их из модулей и шаблона.
                </td>
            </tr>
            <tr>
                <td>
                    ( private static ) check404
                </td>
                <td>
                    Метод проверяет существования файла и если файл не найден выдает 404 ошибку.
                </td>
            </tr>
            <tr>
                <td>
                    ( private static ) widgets
                </td>
                <td>
                    Метод подключает виджеты из коталога "Widgets" и добавляет спец теги используя метод
                    <a href="#Template::addTeg">Template::addTeg</a>.
                    Для поключения виджета в представления модуля.
                </td>
            </tr>
        </table>
    </section>

    <section id="SQL">
        <h3  style="color: #787878;">Запросы в БД. SQL</h3><hr />
        <p>
            Класс SQL взаимодействует с БД используя синтаксисы встроеных запросов
        </p>
        <table class="table">
            <tr>
                <th>Название свойства</th>
                <th>Описание</th>
            </tr>
            <tr>
                <td id="SQL::$allquery">
                    ( private static ) $allquery
                </td>
                <td>
                    Свойства собирает все запросы в бд и затраченное время на их выполнения, в последующем передает данные в
                    в метод <a href="#SQL::get_all_query">get_all_query</a>
                </td>
                <td>
                    ( private static ) $DB_NAME
                </td>
                <td>
                    Свойства передает в SQL запрос имя БД в которую будет отправлен запрос.<br />
                    Данное ствойста игнорируется при прямом обращение в бд через метод <a href="#SQL::que">SQL::que</a>
                    и при обращение через метод <a href="#SQL::prepare">SQL::prepare</a>
                </td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <th>Название метода</th>
                <th>Описание</th>
            </tr>
            <tr>
                <td>
                    ( private static ) query
                </td>
                <td>
                    Основной метод класса SQL, отвечает за отправку запросов в MySQl СУБД по средством PHP PDO.
                    Так же метод собирает информацию о запросах и затраченного времени в свойства
                    <a href="#SQL::$allquery">$allquery</a>. в случае ошибки (в запросе) возвращает: waring.
                    В ином случае возвращает результат из БД.
                </td>
            </tr>
            <tr>
                <td id="SQL::que">
                    ( public static ) que -$query
                </td>
                <td>
                    Метод отправляет любой написанный запрос в БД.<br />
                    $query - указывает запрос который нужно отправить в БД.
                </td>
            </tr>
            <tr>
                <td id="SQL::prepare">
                    ( public static ) prepare -$query
                </td>
                <td>
                    Метод подгтовливает  запрос для отправки в БД используя конструкцию <a href="http://php.net/manual/ru/pdo.prepare.php">PDO::prepare</a>.
                    Для отправки запроса в БД используйте метод <a href="http://php.net/manual/ru/pdostatement.execute.php">execute </a><br />
                    $query - указывает запрос который нужно отправить в БД.
                </td>
            </tr>
            <tr>
                <td id="SQL::select">
                    ( public static ) select -$table -$rows = array('*') -$where = ''
                </td>
                <td>
                    Метод отправляет SELECT в БД и возвращает данные из БД.
                    <ul>
                        <li>( string ) $table - Имя таблицы в которую будет отправлен запрос</li>
                        <li>( array ) $rows - Поля в которые будут выбраны при селекторном запросе. По умолчанию "*" все поля.</li>
                        <li>( string ) $where - Условия по которому будут выбраны поля из БД.</li>
                    </ul>
                </td>
                Пример запроса в БД где статус будет равно 1:<br />
                SQL::select('users', ['*'], 'where status=1');
            </tr>
            <tr>
                <td id="SQL::insert">
                    ( public static ) insert -$table -$data
                </td>
                <td>
                    Метод добавляет в БД запись используя конструкцию INSERT INTO.
                    <ul>
                        <li>( string ) $table - Имя таблицы в которую будет отправлен запрос.</li>
                        <li>( array ) $data - Данные которые будут записаны в таблицу.</li>
                    </ul>
                    Пример добавления пользователя: SQL::insert('users',
                    ['name' => 'Вася', 'password' => '123', 'status' => 1])
                </td>
            </tr>
            <tr>
                <td id="SQL::insertArray">
                    ( public static ) insertArray -$table -$data
                </td>
                <td>
                    Метод добавляет в БД несколько записей используя конструкцию INSERT INTO.
                    <ul>
                        <li>( string ) $table - Имя таблицы в которую будет отправлен запрос.</li>
                        <li>( array ) $data - Данные которые будут записаны в таблицу.</li>
                    </ul>
                    Пример добавления нескольких пользователей: SQL::insert('users', <br />
                    array(['name' => 'Дима', 'password' => '121', 'status' => 0], <br />
                    ['name' => 'Женя', 'password' => '231', 'status' => 0])); <br />
                </td>
            </tr>
            <tr>
                <td id="SQL::update">
                    ( public static ) update -$table -$data -$where = ''
                </td>
                <td>
                    Метод обновляет данные в БД используя конструкцию UPDATE.
                    <ul>
                        <li>( string ) $table - Имя таблицы в которую будет отправлен запрос.</li>
                        <li>( array ) $data - Данные которые будут записаны в таблицу.</li>
                        <li>( string ) $where - Условия по которому будут выбраны поля из БД.</li>
                    </ul>
                    Пример обновления пользователя с id равным 1: <br />SQL::update('users',
                    array(['name' => 'Алексей'], 'where id=1');
                </td>
            </tr>

            <tr>
                <td id="SQL::delete">
                    ( public static ) delete -$table -$where
                </td>
                <td>
                    Метод удаляет данные из БД используя конструкцию DELETE.
                    <ul>
                        <li>( string ) $table - Имя таблицы в которую будет отправлен запрос.</li>
                        <li>( string ) $where - Условия по которому будут выбраны поля из БД.</li>
                    </ul>
                    Пример удаляет пользователя с id равным 1: <br />SQL::delete('users', 'where id=1');
                </td>
            </tr>
            <tr>
                <td id="SQL::get_all_query">
                    ( public static ) get_all_query
                </td>
                <td>
                    Метод возвращает все запросы отправленные в БД используя класс SQL.
                </td>
            </tr>
            <tr>
                <td id="SQL::set_adapter">
                    ( public static ) set_adapter -$db_name = 'default' -$adapter = 'default'
                </td>
                <td>
                    Метод определяет сервер и БД  в которую будет отправлен запрос.
                    И проверяет существования бд в <a href="#config::database">config</a>
                    по средствам метода <a href="#SQL::set_database">set_database</a>
                    <ul>
                        <li>( string ) $db_name - Имя БД в которую будет отправлен запрос указывается в
                            <a href="#config::database">config</a></li>
                        <li>( string ) $adapter -  Имя адаптера (сервера) к которому будет отправлен запрос в БД.
                            Адаптер указывается в <a href="#config::database">config</a></li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td id="SQL::set_database">
                    ( private static ) set_database -$name -$adapter
                </td>
                <td>
                    Метод проверяет существования БД  в текущем адаптере, проверяет в <a href="#config::database">config</a>.
                    <ul>
                        <li>( string ) $name - Имя БД в которую будет отправлен запрос указывается в
                            <a href="#config::database">config</a></li>
                        <li>( string ) $adapter -  Имя адаптера (сервера) к которому будет отправлен запрос в БД.
                            Адаптер указывается в <a href="#config::database">config</a></li>
                    </ul>
                </td>
            </tr>
        </table>
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
