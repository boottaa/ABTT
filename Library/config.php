<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 02.02.17
 * Time: 9:38
 */

return [
    'base' => [
        //домен.
        'site' => "http://www.abtt.dev",
        //Корневая дериктория веб приложения.
        'root_dir' => '/www/xampp/ABTT',
        //Шаблон по умолчанию
        'template' => 'default',
        //Режим разработчика
        'devolper' => true,

    ],
    //Сервера my_sql
    'database' => [
        'default' => [
            //Сервер для подключения к mysql серверу
            'DB_SERV'   =>'192.168.33.10',
            //Пользователь для подключения к mysql серверу
            'DB_USER'   =>'bootta',
            //Пароль для подключения к mysql серверу
            'DB_PASS'   =>'1991',
            'DB_PRIFIX' => '',
            //Указываем все бд на указанном сервере
            //которое будет использовать веб приложения
            //Это сделано для безопасности и возможности сразу увидеть какие бд использует веб приложения.
            'DB_NAME'   => [
                'default',
                'new_q',
                'docs'
            ],
        ],
        'test' => [
            'DB_SERV'   =>'localhost',
            'DB_USER'   =>'root',
            'DB_PASS'   =>'1991',
            'DB_PRIFIX' => '',
            'DB_NAME'   => [
                'users',
                'fname',
                'lname',
                'test',
                'new_q',
            ],

        ],
        //Подключаемся к оборон торгу.
        'oborontorg' => [
            'DB_SERV'   =>'10.31.83.5',
            'DB_USER'   =>'b.ahmedov',
            'DB_PASS'   =>'1',
            'DB_PRIFIX' => '',
            'DB_NAME'   => [

                'fabrikant_ftest',
                //Моя тестовая бд
                'test_boom'
            ],
        ],
    ],
];