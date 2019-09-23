<?php
    namespace Core;

class H {
    //Dump & Die function
    public static function dnd($data){
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        die();
    }
    
    public static function getObjectProperties($obj){
        return get_object_vars($obj);
    }
    
    public static function currentPage(){
        $currentPage = $_SERVER['REQUEST_URI'];
        if($currentPage == PROOT || $currentPage == PROOT.'home/index'){
            $currentPage = PROOT . 'home';
        }
        return $currentPage;
    }

    public static function fetchContent($menu){
        $menuAry = [];
        $menuFile = file_get_contents(ROOT . DS .'app' . DS . $menu . '.json');
        $acl = json_decode($menuFile, true);
        foreach($acl as $key => $val){
            if(is_array($val)){
                $sub = [];
                foreach($val as $k => $v){
                    if($k == 'separator' && !empty($sub)){
                        $sub[$k] = '';
                        continue;
                    }else if($finalVal = ($v)){
                        $sub[$k] = $finalVal;
                    }
                }
                if(!empty($sub)){
                    $menuAry[$key] = $sub;
                }
            }else{
                if($finalVal = ($val)){
                    $menuAry[$key] = $finalVal;
                }
            }
        } 
        return $menuAry;
    }
    public  function fetchHod($acl){
        $sql = "SELECT fname FROM users WHERE acl = $acl ";
        $get =  $this->query($sql)->results();H::dnd($get);
        $menuFile = file_get_contents(ROOT . DS .'app' . DS . $menu . '.json');
        $acl = json_decode($menuFile, true);
        foreach($acl as $key => $val){
            if(is_array($val)){
                $sub = [];
                foreach($val as $k => $v){
                    if($k == 'separator' && !empty($sub)){
                        $sub[$k] = '';
                        continue;
                    }else if($finalVal = ($v)){
                        $sub[$k] = $finalVal;
                    }
                }
                if(!empty($sub)){
                    $menuAry[$key] = $sub;
                }
            }else{
                if($finalVal = ($val)){
                    $menuAry[$key] = $finalVal;
                }
            }
        } 
        return $menuAry;
    }
}