<?php

class Controller{
    
    public function model($modelName = null){
        if(!empty($modelName)){
            $path = MODELS_PATH.'/'.ucfirst($modelName).'.php';
            if (file_exists($path)){
                require_once $path;
                
                return new $modelName();
            } else {
                die("Hata: $modelName adlı model bulunamadı!");
            }
            
        }else{
            echo 'Hata: "model" fonksiyonuna model adı girilmemiş!';
        }
    }
    
    public function view($view = null, $data = false){
        if(!empty($view)){
            echo 'view render edilecek';
        }else{
            echo 'Hata: "view" fonksiyonuna view adı girilmemiş!';
        }
    }
    
}