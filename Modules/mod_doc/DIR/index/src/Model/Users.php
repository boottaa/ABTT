<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 22.12.16
 * Time: 17:16
 */
namespace index\Model;
/**
 * @class Users
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

    /**
     * @method Users.test -
     * @param array $x - передаем имя пользователя
     * @param $z - передаем пароль пользователя
     * @return string
     */
    public function test(array $x, $z){
        return 'hello';
    }
}
