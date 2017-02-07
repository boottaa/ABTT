<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 27.12.16
 * Time: 15:40
 */

namespace Module\shop\Model;

class Orders extends \SQL {
    public static function getorder($id = 'ALL'){
        parent::$DB_NAME = 'shop';
        if($id == 'ALL'){
            $res = parent::select('orders')->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            $res = parent::select('orders',  array('*'), 'where id_order='.$id )->fetch(\PDO::FETCH_ASSOC);
        }
        return $res;
    }
    public static function updateorder($data, $id){
        parent::$DB_NAME = 'shop';
        parent::update('orders', $data, 'where id_order='.$id);
    }
    public static function addorder($data){
        parent::$DB_NAME = 'shop';
        return parent::insert('orders', $data);
    }


    public static function getorder_p($id = 'ALL'){
        parent::$DB_NAME = 'shop';
        if($id == 'ALL'){
            $res = parent::select('order_products')->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            $res = parent::select('order_products',  array('*'), 'where id_order='.$id )->fetch(\PDO::FETCH_ASSOC);
        }
        return $res;
    }
    public static function updateorder_p($data, $id){
        parent::$DB_NAME = 'shop';
        parent::update('order_products', $data, 'where id_order='.$id);
    }
    public static function addorder_p($data){
        parent::$DB_NAME = 'shop';
        return parent::insert('order_products', $data);
    }
}