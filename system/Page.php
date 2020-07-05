<?php
class Page {

    public static $per_page;

    public static function per($number){

            self::$per_page= $number;
     return self::$per_page;
    }

    public static function current(){

            $url= explode("page=", $_SERVER['REQUEST_URI']);
     return isset($url[1]) ? $url[1] : 1 ;
    }

    public static function count($count){

     return (int)($count/self::$per_page);
    }

}