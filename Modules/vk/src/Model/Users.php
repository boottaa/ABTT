<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 22.12.16
 * Time: 17:16
 */
namespace vk\Model;

class Users extends \SQL {
    public function getTest(){
        $res = parent::select('clients')->fetchAll();
        return $res;
    }
}