<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 22.12.16
 * Time: 17:16
 *
 *
 *
SELECT * FROM chatbot.keywords;
WHERE match(keywords) against('год' WITH QUERY EXPANSION);

SELECT * FROM chatbot.keywords
WHERE match(keywords) against('+скольк* ' IN boolean mode) limit 0,2;
REPAIR TABLE chatbot.keywords QUICK;

select * from chatbot.keywords where keywords like '%скольк%' and keywords like '%стоит%' ;
select * from chatbot.keywords where keywords regexp 'скольк.*&стоит.*';
 */
namespace chatbot\Model;

class Chatbot extends \SQL {
    public static function sendAnswer($array){
        parent::$DB_NAME = 'chatbot';
        $search = '+'.implode(' +',$array);;
        $res = parent::que("SELECT * FROM chatbot.keywords WHERE match(keywords) against('{$search}' IN boolean mode) limit 0,2")->fetchAll(\PDO::FETCH_ASSOC);
        return $res;
    }
    public static function getAnswer($id_answer, $id_category = '1'){
        $res = parent::select('answers', array('*'), 'where id_answer='.$id_answer.' and id_category='.$id_category )->fetch(\PDO::FETCH_ASSOC);
        return $res;
    }
    public static function Users($fname, $lname){

    }
    public static function userAnswerInsert($data){
        $res = parent::insert('new_answers', $data);
        return $res;
    }
}