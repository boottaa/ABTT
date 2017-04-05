<?php

//echo '<h3>Подключаемые файлы: </h3>';

if (file_exists('vendor/autoload.php')) {
    $loader = include 'vendor/autoload.php';
}

function autoload($class) {

    $dir   = dirname(__FILE__);
    $class = str_replace('\\', '/', $class);

    $explode_class = explode('/', $class);

    $base_info = [
        'Info',
        'Template',
        'Rout',
        'SQL',
        'Mod',
        'Dashboard'
    ];
    if (in_array($class, $base_info)){
        $class = 'Library/Base/'.$class;
    }elseif($explode_class[0] == 'Module'){
        $class = 'Modules/'.$explode_class[1].'/src/'.$explode_class[2].'/'.$explode_class[3];
    }
    $DirFile = $dir.'/'. $class .'.php';
    //echo '<p style="display: block;background: rgb(207, 207, 207);padding: 10px;">'.$DirFile.'</p>';

    if(file_exists($DirFile)){
        require_once $DirFile;
    }else{
        die('<p style="display: block;background: rgb(207, 207, 207);padding: 10px;"><b><i>( LOADER )</i> Файл не существует: </b>'.$DirFile.'</p>');
    }
}

spl_autoload_register('autoload');