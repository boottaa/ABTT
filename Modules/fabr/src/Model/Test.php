<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 23.12.16
 * Time: 15:27
 */
namespace Module\fabr\Model;

class Test extends \SQL {
    public static function getproduct(){

        parent::set_adapter('default', 'default');
        $res = parent::select('test')->fetchAll(\PDO::FETCH_ASSOC);
        return $res;
    }

}