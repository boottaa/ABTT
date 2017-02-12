<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 28.01.2017
 * Time: 21:08
 */
use Module\docs\Controller\GetDocs;

echo '<pre>';
print_r((new GetDocs())->docs_all());
echo '</pre>';

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

<div class="col-md-3" role="complementary">
    <nav id="bs-docs-sidebar" style="padding-right: 50px;" class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
        <ul class="nav bs-docs-sidenav">
            <li class="active"> <a href="#top">Документация</a> </li>
            <li > <a href="#fall">fall</a> </li>
            <li > <a href="#glyphicons">Glyphicons <span class="caret"></span></a>
                <ul class="nav">
                    <li > <a href="#test">test</a></li>
                    <li > <a href="#test2">test2</a></li>
                </ul>
            </li>

            <li > <a href="#glyphicons">Glyphicons</a> </li>
            <li > <a href="#glyphicons">Glyphicons</a> </li>

        </ul>
    </nav>
</div>



<div class="col-md-9 myDocs" style="margin-bottom: 200px;">
    <h2 id="top" style="color: #787878;">Документация</h2><hr /><br />



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
            var $spy = $(this).scrollspy('refresh')
        });
        $(document).on('activate.bs.scrollspy', function () {
            console.log($('.collapse.in').parent().find('a').attr('href'));
            $('.collapse.in').parent().removeClass('active');
        });
    });
</script>
