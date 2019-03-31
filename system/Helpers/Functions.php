<?php

/**
 * Boş olan dizi anahtarlarını temizler
 */
function array_key_filter($array = []){
    if(count($array)){
        foreach($array as $key => &$value){
            if(is_null($key) && $key != ''){
                unset($array[$key]);
            }
        }
    }
    
    return $array;
}

function view($path, $data = [], $cache = false){
    return (View::make($path, $data, $cache));
}

function config($configFile = null, $configArgs = []){
    return Loader::config($configFile);
}


if(! function_exists('sortindex')){
    function sortindex(array $arr){
        if(isset($arr) && is_array($arr)) {
            $resArr = array();
            $i = 0;
            foreach($arr as $k => $v){
                $resArr[$i] = $v;
                $i++;
            }
            
            return $resArr;
        }
        
        return [];
    }
}


if(! function_exists('dd')){
    /**
     * Dump variable and die script;
     */
    function dd(){
        echo '<pre>';
        array_map(function($x){
            var_dump($x); 
        }, func_get_args());
        die;
    }
}
