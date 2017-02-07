<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 27.12.16
 * Time: 15:14
 */

$data['Name']          = filter_input(INPUT_POST, 'Name');
$data['Email']  = filter_input(INPUT_POST, 'Email');
$data['Phone']   = filter_input(INPUT_POST, 'Phone');
$data['Address']         = filter_input(INPUT_POST, 'Address');
$data['Subscribe_to_Newsletter'] = filter_input(INPUT_POST, 'Subscribe_to_Newsletter');


use Module\shop\Model\Orders;
use Module\shop\Controller\Cart_editor;
if(count(Cart_editor::getproductsincart()) < 1){
    exit('В корзине нет товаров');
}else{

    if(empty($data['Name'])     ||
        empty($data['Email'])   ||
        empty($data['Phone'])   ||
        empty($data['Address']) ||
        empty($data['Subscribe_to_Newsletter'])
    ){
        exit('Упсс... ошибка!!!');
    }else{
        $id_order = Orders::addorder($data);
        if(!empty($id_order)){
            foreach (Cart_editor::getproductsincart() as $k=>$v){
                $data = [
                    'id_order' => $id_order,
                    'id_product' => $k,
                    'id_status' => 1,
                    'product_count' => $v['count']
                ];
                Orders::addorder_p($data);
            }
            session_destroy();
            echo '<script>location.href = "{% SITE %}/shop/success/'.$id_order.'"</script>';
        }
    }
}
//echo ;