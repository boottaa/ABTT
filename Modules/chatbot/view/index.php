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


echo $asd;
?>
<div class="chatbot">
    <!--<div class="chat-panel panel panel-default">
        <div class="panel-heading">
            <h2><i class="fa fa-comments fa-fw"></i>ChatBot</h2>
        </div>

        <div class="panel-body">
            <ul class="chat">


            </ul>
        </div>

        <div class="panel-footer">
            <div class="input-group">
                <input id="btn-input" class="form-control input-sm" placeholder="Type your message here..." type="text">
                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat">
    Send
                                    </button>
                                </span>
            </div>
        </div>

    </div>-->

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