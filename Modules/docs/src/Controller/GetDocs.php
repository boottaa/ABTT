<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 27.12.16
 * Time: 10:05
 */
namespace Module\docs\Controller;
use Module\docs\Model\GetDocs as ModuleGetDocs;
class GetDocs extends ModuleGetDocs{
    public function get_docs($id = 0){
        if($id == 0){
            $this->docs_all();
        }else{
            $this->docs_only($id);
        }
    }
}
?>