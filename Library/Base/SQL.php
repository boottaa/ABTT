<?php
require_once __DIR__.'/Connect.php';
class SQL extends Connect{

    private static $allquery = array();
    private static $DB_NAME = 'default';



    private static function set_database($name, $adapter){
        if(in_array($name, Info::get_db('DB_NAME', $adapter))){
            self::$DB_NAME = $name;
        }else{
            $debug = debug_backtrace()[0];
            echo "<p>Файл: ['{$debug['file']}'] строка['{$debug['line']}']</p> Ошибка в методе: set_adapter класса SQL \n";
            exit();
        }
    }
    private static function query($query, $func = 'select'){
        parent::_connect();
        try{
            parent::$_con->query('SET NAMES utf8;'); //Заплатка можно убрать если в my.conf прописать
            self::$allquery[] = $query.PHP_EOL;
            //echo '<p style="color: red;">'.$query.'</p><br />';
            $result = parent::$_con->query($query);
            $thisID = parent::$_con->lastInsertId();

            if($func == 'select'){
                return $result;
            }else{
                return $thisID;
            };
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }


    //Использует приватный  set_database
    /*
     * @param $adapter - указываем адаптер из Library/config.php[database]
     * @param $db_name - указываем название БД из файла Library/config.php[DB_NAME]
     * */
    public static function set_adapter( $adapter = 'default', $db_name = 'default'){
        //Если имя соединения существует миняем , иначе выдаем ошибку
        if(!empty(Info::get_db('', $adapter))){
            parent::$DB_ADAPTER = $adapter;
            self::set_database($db_name, $adapter);

        }else{
            $debug = debug_backtrace()[0];
            echo "<p>Файл: ['{$debug['file']}'] строка['{$debug['line']}']</p> Ошибка в методе: set_adapter класса SQL \n";
            exit();
        }
    }







    public static function select($table, $rows = array('*'), $where = ''){
        $table = parent::db_prifix().$table;

        $rows = implode(", ", $rows);
        $query = "SELECT $rows FROM `".self::$DB_NAME."`.`$table` $where";
        //echo '<p style="margin-left: 300px;">'.$query.'</p>';
        return self::query($query, __FUNCTION__);
    }
    
    //$data данные в ассоцеативном массиве
    public static function insert($table, $data){
            $table = parent::db_prifix().$table;
            $rows = '';
            $values = '';
            $count = 0;
            foreach ($data as $key => $value) {
                ++$count;
                if(count($data) > $count){
                    $key = '`'.$key.'`, ';
                    $value = "'".$value."', ";
                }else{
                    $key = '`'.$key.'`';
                    $value = "'".$value."'";
                }
                $rows .= $key;
                $values .= $value;
            }
            $query = "INSERT INTO `".self::$DB_NAME."`.`$table` ( $rows ) VALUES ( $values )";
            //echo $query;
            return self::query($query, __FUNCTION__);
    }

    public static function insertArray($table, $data){
        $table = parent::db_prifix().$table;
        $VALUES = '';
        foreach ($data as $index=>$val) {
            if(count($data) == ($index+1)){
                $rows = array_keys($val);
                $rows = implode('`, `', $rows);
                $RFQ = '';
            }else{
                $RFQ = ', ';
            }
            $VALUES .= "( '".implode("','", $val)."' )".$RFQ;
        }
        $query = "INSERT INTO `".self::$DB_NAME."`.`'.$table.'` ( '.$rows.' )".$VALUES;
        echo $query;
        return self::query($query, __FUNCTION__);
    }

    public static function update($table, $data, $where = ''){
        $value = '';
        $num = 0;
        $count = count($data);
        foreach ($data as $v=>$k){
            $num++;
            if($num <  $count){
                $EOD = ', ';
            }else{
                $EOD = '';
            }
            $value .= $v."='".$k."'".$EOD;
        }
        $table = parent::db_prifix().$table;
        $query = "UPDATE `".self::$DB_NAME."`.`$table` SET $value $where";
        //echo '<p style="margin-left: 300px;">'.$query.'</p>';
        return self::query($query, __FUNCTION__);
    }
    public static function que($query){
        return self::query($query);
    }

    public static function delete($table, $where){
        $table = parent::db_prifix().$table;
        $query = "DELETE FROM `".self::$DB_NAME."`.`$table` $where";
        //echo '<p style="margin-left: 300px;">'.$query.'</p>';
        return self::query($query, __FUNCTION__);
    }
    public function test(){
        return 'Im working';
    }

    public static function get_all_query(){
        return self::$allquery;
    }

    
}