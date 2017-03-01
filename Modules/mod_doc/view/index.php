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
    <ul>
        <li>@method - Имя метода - его описание.</li>
        <li>@function - Имя функции - ее описание.</li>
        <li>@param - Имя входного параметра - его описание.</li>
        <li>@class - Имя класса - его описание</li>
        <li>@exemple - Пример работы</li>
        <li>@class - Имя класса - его описание</li>
        <li>@var - Переменная - ее описание</li>
    </ul>

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



function ff(&$array){
    $str = json_encode($array);
    $need = [
        '@method' => '<i>Метод</i>:',
        '@function' => '<i>Функция</i>:',
        '@param' => '<i>Входной параметр</i>:',
        '@return' => '<i>Возвращает</i>:',
        '@class' => '<i>Класс</i>:',
        '@exemple' => '<i>Пример</i>:',
        '@var' => '<i>Переменная</i>:'
    ];

    $r = str_replace(array_keys($need), array_values($need), $str);
    $array = json_decode($r, true);
    return $array;
}

$script = "<script>

    $(document).ready(function() {

        $('a[data-toggle=\"tab\"]').on('shown.bs.tab', function (e) {
            $(e.target).parent().removeClass('active'); // newly activated tab
        });

        $(\".bs-docs-sidebar\").metisMenu({
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
    });
</script>";

echo __DIR__.'/test.php';
if(file_put_contents(__DIR__.'/docs/test.php', $menuHTML.$dataHTML.$script)){
    echo 'Файл создан';
}
?>



