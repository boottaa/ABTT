<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 23.12.16
 * Time: 15:27
 */
namespace Module\docs\Model;

/*
CREATE SCHEMA `docs` DEFAULT CHARACTER SET utf8 ;
CREATE TABLE `docs`.`docs_docs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `alias` VARCHAR(255) NOT NULL,
  `text` TEXT NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `docs`.`docs_alias` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`));

*/

class GetDocs extends \SQL {

    /*public function __construct()
    {
    }*/

    public function docs_all(){
        parent::set_adapter('docs');
        $res = parent::select('docs_docs')->fetchAll(\PDO::FETCH_ASSOC);
        return $res;
    }
    public function docs_only($id){
        parent::set_adapter('docs');
        $res = parent::select('docs_docs', ['*'], 'where id='.$id)->fetchAll(\PDO::FETCH_ASSOC);
        return $res;
    }
}