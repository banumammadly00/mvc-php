<?php
class Token {

    public static function create(){
        Session::set('token', base64_encode(random_bytes(32)));
    }

    public static function get(){

        return Session::get('token');
    }

    public static function check(){

        $token= Session::get('token');
        if(isset($token) && !empty($token)){
          //unset($_SESSION['token']);
            return true;
        }else{
            return false;
        }
    }
}