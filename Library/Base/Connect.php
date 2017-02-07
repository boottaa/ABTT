<?php

class Connect{
    protected static
        $_ins,
        $_con,
        $DB_ADAPTER = 'default';
    private function __construct(){

        try{
            //echo Info::get_db('DB_SERV',self::$DB_ADAPTER);
           //Соединение с бд
            //self::$_con = new \PDO("mysql:server=$this->DB_SERV; Database=$this->DB_NAME", $this->DB_USER, $this->DB_PASS);
            self::$_con = new \PDO("mysql:host=".Info::get_db('DB_SERV',self::$DB_ADAPTER), Info::get_db('DB_USER', self::$DB_ADAPTER), Info::get_db('DB_PASS', self::$DB_ADAPTER) );
            self::$_con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch( PDOException $e){
            //возврощает ошибку при соеденение с бд
            die('Соединение оборвалось:'. $e->getMessage());
        }
    }
    public static function db_prifix (){
        return Info::get_db('DB_PRIFIX', self::$DB_ADAPTER) ?? '';
    }
    public static function _connect(){
        if(self::$_ins instanceof self){
            return self::$_ins;
        }else{
            return self::$_ins = new self;
        }
    }
}
