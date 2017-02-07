<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 23.12.16
 * Time: 15:27
 */
namespace Module\shop\Model;

class Products extends \SQL {
    public static function getproduct($id = 'ALL'){
        //parent::$DB_NAME = 'shop';
        //parent::set_adapter('data');
        if($id == 'ALL'){
            $res = parent::select('products')->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            $res = parent::select('products',  array('*'), 'where id_product='.$id )->fetch(\PDO::FETCH_ASSOC);
        }
        return $res;
    }
    public static function updateproduct($data, $id){
        parent::$DB_NAME = 'shop';
        parent::update('products', $data, 'where id_product='.$id);
    }
    public static function addproduct($data){
        parent::$DB_NAME = 'shop';
        parent::insert('products', $data);
    }
}