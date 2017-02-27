<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 25.02.2017
 * Time: 21:43
 */



/**
 * @function ScanDir - Сканирует дериктории
 * @param $dir - дериктория в которой будет сканирование
 * @param $meme - Тип файлов которые нужно просканировать
 * @return array - Возвращает массив со всеми классами, методами и функциями
 */
function A_ScanDir($dir, $meme)
{
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir), RecursiveIteratorIterator::SELF_FIRST);
    $result = [];
    foreach ($iterator as $path) {
        $classDescription = '';
        $type = '';
        if (in_array($path->getExtension(), $meme)) {

            $filecontent = file_get_contents($path->getPathname());

            preg_match_all('/\/\*\*(.*)\*\//Us', $filecontent, $match);
            $class = '';
            foreach ($match[1] as $val) {

                if (isset($val)) {
                    preg_match_all('/@(.*)[\n|\r]/Us', $val, $matchParams);
                    $continue = false;

                    foreach ($matchParams[0] as $mm) {
                        /*echo $mm.'<hr />';*/
                        if (preg_match('/(\@class)\s(\w*)\b(\s\-\s|\s\-|\-\s|\-)?(\w*)?/', $mm, $cl)) {
                            $classDescription = $mm;
                            $class = trim($cl[2]);
                            $continue = true;
                            $type = 'method';
                        } elseif (preg_match('/(@function)\s(\w*)\b(\s\-\s|\s\-|\-\s|\-)?(\w*)?/', $mm, $function)) {
                            $classDescription = '';
                            $class = trim($function[2]);
                            $type = 'function';
                        }
                    }
                    if (empty($matchParams[1]) || $continue == true) {
                        continue;
                    } else {
                        $pa = str_replace($dir . '/', '', $path->getPathname());
                        $result[$pa][$class]['description'] = $classDescription;
                        $result[$pa][$class]['type'] = $type;
                        $result[$pa][$class]['methods'][] = $matchParams[0];
                    }
                }
            }
        }
    }
    return $result;
}
