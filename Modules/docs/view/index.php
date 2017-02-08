<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 28.01.2017
 * Time: 21:08
 */
?>
{% MENU %}

<style>
    .nav>li>ul>li{
        padding-left: 40px;
    }
</style>

<div class="col-md-3" role="complementary">
    <nav id="bs-docs-sidebar" class="bs-docs-sidebar hidden-print hidden-sm hidden-xs affix">
        <ul class="nav bs-docs-sidenav">
            <li class="active"> <a href="#top">Документация</a> </li>
            <li > <a href="#fall">fall</a> </li>
            <li > <a href="#glyphicons">Glyphicons <span class="caret"></span></a>
                <ul class="nav">
                    <li > <a href="#glyphicons">Glyphicons</a>
                    <li > <a href="#glyphicons">Glyphicons</a>
                </ul>
            </li>
            <li > <a href="#glyphicons">Glyphicons</a> </li>
            <li > <a href="#glyphicons">Glyphicons</a> </li>

        </ul>
    </nav>
</div>

<div class="col-md-9">
    <h2 style="color: #787878;">Документация</h2><hr /><br />



</div>

<script>

    $(document).ready(function() {
        $(".bs-docs-sidenav").metisMenu();

        $('[data-spy="scroll"]').each(function () {
            var $spy = $(this).scrollspy('refresh')
        });
    });
</script>
