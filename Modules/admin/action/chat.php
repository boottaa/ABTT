<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 28.12.16
 * Time: 15:54
 */
$message   = filter_input(INPUT_POST, 'message');
$check     = filter_input(INPUT_POST, 'check');
$author    = filter_input(INPUT_POST, 'author');
$sessionid = filter_input(INPUT_POST, 'sessionid');
$deletedFile = filter_input(INPUT_POST, 'deleted');


$filesave = dirname(__DIR__).'/chat/'.$sessionid.'.txt';

if ($deletedFile == '1' && !empty($check)){
    unlink($filesave);
}

$data = [
    'message' => $message,
    'check'   => $check,
    'author'  => $author,
    'date'    => date("H:i:s")
];





if(!empty($message) && !empty($check) && !empty($author)):
    if (file_exists($filesave)){
        $txt = NULL;
    }else{
        $txt = 'Admin :||: 16:33:00 :||: Добрый день! Чем я могу вам помочь?'.PHP_EOL;
    }
    file_put_contents( $filesave, $txt.$author.' :||: '.date("H:i:s").' :||: '.$message.PHP_EOL, FILE_APPEND | LOCK_EX );
    if(trim($author) == 'Admin'):
?>

    <!--От администратора--->
        <li class="left clearfix body-chat Admin">
                                    <span class="chat-img pull-left">
                                        <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                                    </span>
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">Админ</strong>
                    <small class="pull-right text-muted">
                        <i class="fa fa-clock-o fa-fw"></i><i class="chat-addtime"><?=date("H:i:s");?></i>
                    </small>
                </div>
                <p class="chat-message">
                    <?=$message ?>
                </p>
            </div>
        </li>
    <?php else: ?>
        <!--От клиента--->
        <li class="right clearfix body-chat Client">
            <span class="chat-img pull-right">
                <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
            </span>
            <div class="chat-body clearfix">
                <div class="header">
                    <small class=" text-muted">
                        <i class="fa fa-clock-o fa-fw"></i><i class="chat-addtime"><?=date("H:i:s");?></i>
                    </small>
                    <strong class="pull-right primary-font">Клиент</strong>
                </div>
                <p id="chat-message">
                    <?=$message ?>
                </p>
            </div>
        </li>



<?php
    endif;
elseif(empty($message) && !empty($check) && $author == 'UPDATE' ):

else:
    echo '<script>history.back()</script>';
endif;
?>
