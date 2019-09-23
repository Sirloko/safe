<?php
    namespace Core;

class Cookie{
    public static function set($name, $value, $expiry){
        $now = time()+$expiry;
        if(setCookie($name, $value, (int)$now, '/')){
            return true;
        }
        return false;
    }

    public static function delete($name){
        self::set($name, '', time() -1);
    }

    public static function get($name){
        return $_Cookie[$name];
    }

    public static function exists($name){
        return isset($_Cookie[$name]);
    }
}