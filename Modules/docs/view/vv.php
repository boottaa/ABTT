<?php
/**
 * Created by PhpStorm.
 * User: bootta
 * Date: 16.02.17
 * Time: 15:38
 */

class ssql{
    private $query;
    private static $DB_NAME = 'db_name';
    public function select($table, array $rows = ['*']){
        $rows = implode(", ", $rows);
        $this->query = "select {$rows} FROM ".self::$DB_NAME.'.'.$table;
        return $this;
    }

    public function where ($where){
        $this->query .= ' where '.$where;
        return $this;
    }
    public function query(){
        echo $this->query;
    }
}


class stat{
    private static $query;
    private static $DB_NAME = 'db_name';
    public static function select($table, array $rows = ['*']){
        $rows = implode(", ", $rows);
        self::$query = "select {$rows} FROM ".self::$DB_NAME.'.'.$table;
        //echo self::$query;
        return new self();
    }

    public function where($where){
        self::$query .= ' where '.$where;
        return $this;
    }

    public function gg($as = 'heheh'){
        self::$query .= $as;
        return new self();
    }
    public function ec(){
        echo '<pre>';
        print_r(__);
        echo '</pre>';
        echo self::$query;
    }
}



stat::select('stat_test')->where('id in ("1", "2")')->gg()->ec();

$dir = Info::get('root_dir');
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir), RecursiveIteratorIterator::SELF_FIRST );
$result = [];
foreach ( $iterator as $path ) {
    //if($path->isDot()) continue;
    if ($path->getExtension() == 'php') {
        $result[] = $path->getPathname() . PHP_EOL;
    } else {
      //  $result[] = $path->getPathname() . PHP_EOL;
    }
}
echo '<pre>';
print_r($result);
echo '</pre>';
?>
<div class="test">test</div>
<script>
    window.B = function($x){

        var $elem = document.querySelector($x);

        return this.ob = {
            html : function($text){
                $elem.innerHTML = $text;
            }
        }
    };


</script>
