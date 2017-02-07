<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 01.02.17
 * Time: 15:07
 */

namespace Library\Rights;

//Общие права пользователей;

class RightsControll {
    public static function get_rights($firm_id, $user_id){
        \SQL::set_adapter('oborontorg', 'test_boom'); //fabrikant_ftest  //test_boom

        $res = \SQL::select('users', ['*'], "where firm_id = $firm_id AND id = $user_id")->fetchAll(\PDO::FETCH_ASSOC);

        return $res;
    }
    public static function add_rights(){

    }
    public static function del_rights(){

    }
    public static function check_rigths(){

    }


}