<?php
Template::addStyle('admin/metisMenu.min.css');
Template::addScript('admin/metisMenu.min.js');
Template::addScript('mod_doc/tab.js');
include dirname(__DIR__).'/src/ScanDir.php';
$dir = dirname(__DIR__).'/DIR';
$meme = ['php', 'html']; //Перечесляем тип файлов которые будем индексировать.

$result = A_ScanDir($dir, $meme);



$dataHTML = '<div class="tab-content col-lg-offset-4 col-lg-8">';
$dataHTML .= '<div role="tabpanel" class="tab-pane active" >
<h2>Основные правила</h2>
<p>
    <ul>
        <li>@method - Имя метода - его описание.</li>
        <li>@function - Имя функции - ее описание.</li>
        <li>@param - Имя входного параметра - его описание.</li>
        <li>@class - Имя класса - его описание</li>
        <li>@exemple - Пример работы</li>
        <li>@class - Имя класса - его описание</li>
        <li>@var - Переменная - ее описание</li>
    </ul>
</p>
</div>';

$menuHTML = '<nav id="bs-docs-sidebar" style="padding-right: 50px;" class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
		<ul class="nav bs-docs-sidenav">';
foreach (ff($result) as $key=>$val){
    $href = '';
    $menuHTML .= '<li><a href="#">'.$key.'<span style="margin-top: 8px;position: absolute; right: 8px;" class="caret"></span></a>';
    $menuHTML .= '<ul class="nav" role="tablist">';
    foreach ($val as $class=>$v){
        $href = str_replace(['/', '.'], '_', "{$key}-{$class}");
        $menuHTML .= '<li><a href="#'.$href.'" aria-controls="profile" role="tab" data-toggle="tab" style="padding-left: 40px;">'.$class.'</a></li>';

        $dataHTML .= '<div role="tabpanel" class="tab-pane" id="'.$href.'">';
        $dataHTML .= '<h2>'.$class.'</h2><hr />';

        foreach ($v['methods'] as $cx){
            $dataHTML .= implode('<br />', $cx).'<hr />';
        }
        $dataHTML .= '</div>';
    }
    $menuHTML .= '</li></ul>';
}
$menuHTML .= '</ul></nav>';


//
/*echo '<pre class="col-lg-offset-4 col-lg-8">';
print_r(ff($result));
echo '</pre>';*/
function ff(&$array){
    $str = json_encode($array);
    $need = [
        '@method' => 'Метод:',
        '@function' => 'Функция:',
        '@param' => 'Входной параметр:',
        '@return' => 'Возвращает:',
        '@class' => 'Класс:',
        '@exemple' => 'Пример:'
    ];

    $r = str_replace(array_keys($need), array_values($need), $str);
    $array = json_decode($r, true);
    return $array;
}

?>


<!--<ul class="nav nav-tabs">
    <li ><a href="#index_src_Controller_Users.php-Users23" data-toggle="tab">Home</a></li>
    <li ><a href="#profile" data-toggle="tab">Profile</a></li>
    <li><a href="#messages" data-toggle="tab">Messages</a></li>
    <li><a href="#settings" data-toggle="tab">Settings</a></li>
</ul>

<div class="tab-content">
    <div class="tab-pane" id="index_src_Controller_Users.php-Users23">home</div>
    <div class="tab-pane" id="profile">profile</div>
    <div class="tab-pane" id="messages">messages</div>
    <div class="tab-pane" id="settings">settings</div>
</div>-->

<?php

echo $menuHTML.$dataHTML;
?>

<script>

    $(document).ready(function() {

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $(e.target).parent().removeClass('active'); // newly activated tab
            //e.relatedTarget) // previous active tab
        })

        $(".bs-docs-sidebar").metisMenu({
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

