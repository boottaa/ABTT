<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 26.03.2017
 * Time: 18:53
 */
namespace Module\vk\api;
class method_vk {

    private $access_token = '63e61028e7c0cbbfc1fdca60958bf7882731fb7e09d2fed32b2813387fbf18fee0dfb9e720783b6795af9';
    private $url = "https://api.vk.com/method/";

    /**
     * Конструктор
     */
    public function __construct($access_token = '') {
        if(!empty($access_token)){
            $this->access_token = $access_token;
        }
    }

    /**
     * Делает запрос к Api VK
     * @param $method
     * @param $params
     */
    public function method($method, $params = null) {

        $p = "";
        $response = [];
        $URL_REQUEST = [];

        if( $params && is_array($params) ) {
            foreach($params as $key => $param) {
                if ($key == 'owner_id'){
                    $p .= ($p == "" ? "" : "&") ."{% owner_id %}";
                }else{
                    $p .= ($p == "" ? "" : "&") . $key . "=" . urlencode($param);
                }
            }
        }
        $URL_REQUEST[0] = $this->url . $method . "?" . ($p ? $p . "&" : "") . "access_token=" . $this->access_token;

        if (is_array($params['owner_id'])){
            foreach ($params['owner_id'] as $val){
                $URL_REQUEST[] = str_replace('{% owner_id %}','owner_id=-'.$val, $URL_REQUEST[0]);
                $response[] = json_decode(file_get_contents(str_replace('{% owner_id %}','owner_id='.$val, $URL_REQUEST[0])), true);
            }
            unset($URL_REQUEST[0]);
        }else{
            $response[] = json_decode(file_get_contents(str_replace('{% owner_id %}','owner_id='.$params['owner_id'], $URL_REQUEST[0])), true);
        }

      /*  echo '<pre>';
        print_r($URL_REQUEST);*/


        //$response = file_get_contents($this->url . $method . "?" . ($p ? $p . "&" : "") . "access_token=" . $this->access_token);

        //if( $response ) {
        return $response;//json_decode($response, true);
        //}
        //return false;
    }
}