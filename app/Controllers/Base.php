<?php
class Base extends Controller{

    public function __construct (){
      parent:: __construct();
    }

    public function log($action){

        Session::init();
        date_default_timezone_set("Asia/Baku");
        $log= $this->load->model("LogModel");
        $bind_log= [
           'name'   =>  Session::get('username'),
           'action' =>  $action,
           'date'   =>  date("Y-m-d H:i")
         ];

        $log->log_add($bind_log);

      }
}