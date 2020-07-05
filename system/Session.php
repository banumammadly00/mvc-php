<?php
class Session{


    public static function init(){
        session_start();
    }

    public static function set($key, $value){
           $_SESSION[$key]= $value;
    }

    public static function get($key){

       if(isset($_SESSION[$key])){

           return $_SESSION[$key];

        } else{
            return false;
        }
    }

    public static function time($key,$timeout,$location){

        date_default_timezone_set("Asia/Baku");
        $time= $_SESSION[$key];

        if((time()- $time) > $timeout){
            session_destroy();
            header("Location:". SITE_URL."/".$location);
        }
    }

    public static function end(){
         session_destroy();
    }

}