<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 05.01.2017
 * Time: 14:14
 */

/*ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);*/

?>
<div class="chatbot">

</div>
<script>
    $(function(){
        var getsessions = [
            '<?=session_id() ?>'
        ];
        var params = {};
        params.block = '.chatbot';
        params.role = 'Client';
        params.sessionid = getsessions;
        $.ChatBot(params);
    });
</script>