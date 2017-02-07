<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 27.12.16
 * Time: 16:14
 */
if( !empty(Info::getUri('3')) ):
?>


<h2>Ваша заявка принята</h2><hr />
    <center>
        <img style="cursor: pointer;" onclick="location.href = '{% SITE %}/shop'" src="https://www.shareicon.net/data/2016/08/20/817720_check_395x512.png" alt="заявка принята">
    </center>
<?php else: ?>
    <script>location.href = '{% SITE %}/shop';</script>
<?php endif; ?>
