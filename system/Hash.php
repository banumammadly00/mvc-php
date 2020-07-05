<?php
// define("SITE_URL", "/mvc-test");
class Hash{

    public static function crypt($password){
       return hash_hmac('md5', $password,'secret');
    }
}