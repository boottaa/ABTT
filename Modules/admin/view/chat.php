<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 28.12.16
 * Time: 14:12
 */

//Template::addScript('admin/chat.js');
Template::addScript('admin/newChat.js');

?>
{% ADMIN:MENU %}

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Чаты</h1>
        </div>



        <!----------->
        <div class="contenschats col-lg-12">

        </div>
        <!------------->

    </div>
</div>

<script>

    $(function(){

        var params = {};
        params.block = '.contenschats';
        params.class = "col-lg-3";
        params.css = {
            'height'  : 'auto',
            'padding' : '0px',
            'margin'  : '0px'
        }
        params.role = 'Admin';
        $.projectChat(params);
    });

</script>



