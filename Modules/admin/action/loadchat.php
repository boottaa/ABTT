<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 29.12.16
 * Time: 11:03
 */
$res = '';
$sessionid = session_id();
$fileChat = dirname(__DIR__).'/chat/'.$sessionid.'.txt';
if (file_exists($fileChat)){
    $res = file_get_contents($fileChat);
}

if(!empty($_POST['action']) && $_POST['action'] == 'UPDATE'):
?>
    <?php if(!empty($res)){
    $mess = explode(PHP_EOL, $res);  ?>
    <?php foreach ($mess as $vm):
        $tx = explode(':||:', $vm);
        if(empty($tx[0])) break;
        if(trim($tx[0]) == 'Admin'):
            ?>
            <li class="left clearfix body-chat">
                    <span class="chat-img pull-left">
                       <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                    </span>
                <div class="chat-body clearfix">
                    <div class="header">
                        <strong class="primary-font"><?=$tx[0] ?></strong>
                        <small class="pull-right text-muted">
                            <i class="fa fa-clock-o fa-fw"></i><i class="chat-addtime"><?=$tx[1] ?></i>
                        </small>
                    </div>
                    <p class="chat-message">
                        <?=$tx[2] ?>
                    </p>
                </div>
            </li>
        <?php else: ?>

            <li class="right clearfix body-chat">
                                    <span class="chat-img pull-right">
                                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                <div class="chat-body clearfix">
                    <div class="header">
                        <small class=" text-muted">
                            <i class="fa fa-clock-o fa-fw"></i><i class="chat-addtime"><?=$tx[1] ?></i>
                        </small>
                        <strong class="pull-right primary-font">Клиент</strong>
                    </div>
                    <p id="chat-message">
                        <?=$tx[2] ?>
                    </p>
                </div>
            </li>

            <?php

        endif;

    endforeach;} ?>


<?php
else:
?>


<div style="position: fixed; width: 300px; z-index: 9999; height: auto; bottom: 0px; right: 19%; padding: 0px; margin: 0px;" class="chat-panel chat-clients panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-comments fa-fw"></i> Чат
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-default btn-xs close-chat" data-toggle="dropdown">
                &nbsp;&#10006&nbsp;
            </button>
        </div>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <ul class="chat">
            <!---chat--->

                    <li class="left clearfix body-chat">
                                    <span class="chat-img pull-left">
                                        <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font">Admin</strong>
                                <small class="pull-right text-muted">
                                    <i class="fa fa-clock-o fa-fw"></i><i class="chat-addtime"><?= date("H:i:s") ?></i>
                                </small>
                            </div>
                            <p class="chat-message">
                                Добрый день! Чем я могу вам помочь?
                            </p>
                        </div>
                    </li>

            <?php if(!empty($res)){

            $mess = explode(PHP_EOL, $res);  ?>
            <?php foreach ($mess as $vm):
            $tx = explode(':||:', $vm);
            if(empty($tx[0])) break;
            if(trim($tx[0]) == 'Admin'):
            ?>
                <li class="left clearfix body-chat">
                    <span class="chat-img pull-left">
                       <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font"><?=$tx[0] ?></strong>
                            <small class="pull-right text-muted">
                                <i class="fa fa-clock-o fa-fw"></i><i class="chat-addtime"><?=$tx[1] ?></i>
                            </small>
                        </div>
                        <p class="chat-message">
                            <?=$tx[2] ?>
                        </p>
                    </div>
                </li>
            <?php else: ?>

                <li class="right clearfix body-chat">
                                    <span class="chat-img pull-right">
                                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <small class=" text-muted">
                                <i class="fa fa-clock-o fa-fw"></i><i class="chat-addtime"><?=$tx[1] ?></i>
                            </small>
                            <strong class="pull-right primary-font">Клиент</strong>
                        </div>
                        <p id="chat-message">
                            <?=$tx[2] ?>
                        </p>
                    </div>
                </li>

                <?php

            endif;

            endforeach;} ?>
            <!---------->
        </ul>
    </div>
    <!-- /.panel-body -->
    <div class="panel-footer">
        <div class="input-group">
            <input type="hidden" name="author" id="btn-input-chat-author" value="Client">
            <input type="hidden" name="sessionid" id="btn-input-chat-session_id" value="<?=$sessionid ?>">
            <input id="btn-input-chat-message" type="text" class="form-control input-sm" placeholder="Введите ответ..." />
            <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm" id="btn-chat">
                                Отправить
                            </button>
                        </span>
        </div>
    </div>
    <!-- /.panel-footer -->
</div>
<?php
endif;
?>