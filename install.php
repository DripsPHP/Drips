<?php
function drips_rcopy($src, $dst){
    $handle = opendir($src);
    @mkdir($dst);
    while($file = readdir($handle)){
        if (!in_array($file, ['.', '..'])){
            if (is_dir($src.'/'.$file)){
                drips_rcopy($src.'/'.$file,$dst.'/'.$file);
            } else {
                copy($src.'/'.$file, $dst.'/'.$file);
            }
        }
    }
    closedir($handle);
}
$to_copy = array(
    __DIR__.'/../../../src' => __DIR__.'/src',
    __DIR__.'/../../../public' => __DIR__.'/public',
    __DIR__.'/../../../tmp' => __DIR__.'/tmp',
    __DIR__.'/../../../logs' => __DIR__.'/logs',
    __DIR__.'/../../../config' => __DIR__.'/config'
);
foreach($to_copy as $target => $source){
    if(!is_dir($target) && is_dir($source)){
        drips_rcopy($source, $target);
    } elseif(!file_exists($target) && is_file($source)){
        copy($source, $target);
    }
}
copy(__DIR__.'/.htaccess', __DIR__.'/../../../.htaccess');
