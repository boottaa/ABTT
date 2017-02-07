<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 22.12.16
 * Time: 15:41
 */
namespace chatbot\Controller;
use Module\chatbot\Model\Chatbot;


class Logick extends Chatbot{

    public static function addUserAnswer($chatbotKeywords_id, $user_answer_treated = array(), $user_answer_original){
        if(is_array($user_answer_treated)){
            $implode_user_answer_treated = implode(' ', $user_answer_treated);
        }
        $data = [
            'chatbot_keywords_id' => $chatbotKeywords_id,
            'user_answer_treated' => $implode_user_answer_treated,
            'user_answer_original' => $user_answer_original,
        ];
        //print_r($data);
        parent::userAnswerInsert($data);
    }
    public static function getUserInfo($teg){

    }
    public static function addUserInfo($id){

    }
    public static function addUser($fname, $lname){

    }
}