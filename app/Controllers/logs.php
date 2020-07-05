<?php
class Logs extends Controller{

    public function __construct (){
        parent:: __construct();
     }

     public function list(){

        Session::init();
        $model= $this->load->model("LogModel");
        $page_count= $model->count();

        $data= [
            "logs"     =>  $model->list(Page::current(), Page::per(21)),
            "page_number"  =>  Page::count($page_count),
            "page"         =>  Page::current()
          ];

         $this->load->view("logs", $data);
    }
}