<?php


$dir = dirname(__DIR__).'/DIR';
$meme = ['php', 'html']; //Перечесляем тип файлов которые будем индексировать.
$needStroc = ['class'];


$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir), RecursiveIteratorIterator::SELF_FIRST );
$result = [];
//Найти все классы - ^class(.*)(extends (.*))?({)?\n


$x = 0;
foreach ( $iterator as $path ) {
    $classDescription = '';
    $type = '';
    if (in_array($path->getExtension(), $meme)) {

        $filecontent = file_get_contents($path->getPathname());

       preg_match_all( '/\/\*\*(.*)\*\//Us', $filecontent, $match);
        $class = '';
        foreach ($match[1] as $val ){

            if(isset($val)){
                preg_match_all('/@(.*)[\n|\r]/Us', $val, $matchParams);
                $continue = false;

                foreach ($matchParams[0] as $mm){
                    /*echo $mm.'<hr />';*/

                    if(preg_match('/(\@class)(.*)[\s|-]?/', $mm, $cl)){
                        $class = trim($cl[2]);
                        $classDescription = $mm;
                        $continue = true;
                        $type = 'methods';
                    }elseif (preg_match('/(\@function)(.*)[\s|-]/', $mm, $function)){
                        $class = trim($function[2]);
                        $type = 'function';
                    }
                }
                if(empty($matchParams[1]) || $continue == true){
                    continue;
                }else{
                    $pa = str_replace($dir.'/', '', $path->getPathname());
                    $result[$pa][$class]['description'] = $classDescription;
                    $result[$pa][$class][$type][] = $matchParams[0];
                }
            }
        }
        //echo htmlspecialchars($filecontent).'<hr />';
        /*$x++;
        if($x>=3){
            break;
        }*/
    }

}
echo '<pre>';
print_r($result);
echo '</pre>';
