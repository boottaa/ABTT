<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 22.12.16
 * Time: 11:04
 */
use Module\index\Model\Users;
//Users::getTest();


/*while (1==1){
    echo 'xx';
}*/


?>
{% MENU %}

<div class="jumbotron">
    <h2>Добро пожаловать в проект Alfa</h2><hr /><br />
    <p>
        Привет мир! Данный проект посвещен для людей желающих начать программировать, но пока незнающех с чего стоит начинать (а на что не стоит тратить свое время). Я предлогаю вам бесплатные симинар после чего вы сделаете для себя выводы стоит ли продолжать.
    </p>
    <br />
    <p>
        <a class="btn btn-lg btn-primary" href="../../components/#navbar" role="button">Записаться на бесплатный симинар »</a>
    </p>
</div>
<!--<p class="asd">
    heheh
</p>-->


<script>
    $(function(){
        var getsessions = [
            '<?=session_id() ?>'
        ];
        var params = {};
        params.css = {
            'position': 'fixed',
            'width'   : '300px',
            'z-index' : '9999',
            'height'  : 'auto',
            'bottom'  : '0px',
            'right'   : '19%',
            'padding' : '0px',
            'margin'  : '0px'
        }
        params.role = 'Client';
        params.sessionid = getsessions;
        $.projectChat(params);
    });
</script>
