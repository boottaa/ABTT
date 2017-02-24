<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 22.12.16
 * Time: 17:16
 */
namespace index\Model;
/**
 * Class Users
 * @package index\Model
 * 
 */
class Users extends \SQL {

    /**
     * @return array
     */
    public function getTest(){
        $res = parent::select('clients')->fetchAll();
        return $res;
    }
}