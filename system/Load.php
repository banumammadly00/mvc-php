<?php
class Load {

    public function model($filename){
        include "app/Models/".$filename.".php";
        return new $filename();
    }

    public function view ($filename, $data=null){
        $data!=null ? extract($data) : $data ;
        include "app/Views/".$filename.".php";
    }
}