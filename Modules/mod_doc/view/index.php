<?php

$dir = dirname(__DIR__).'/DIR';
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