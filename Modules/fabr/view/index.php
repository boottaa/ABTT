<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 28.01.2017
 * Time: 21:08
 */
use Module\fabr\Model\Test;
use Library\Rights\RightsControll;


echo '<pre>';

print_r(RightsControll::get_rights(1, 1));
//print_r(Test::getproduct());
echo '</pre>';