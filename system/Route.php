<?php
class Route{
    public function __construct(){

    if(isset($_GET['url'])){

        $url= $_GET['url'];
        $url= rtrim($url, "/");
        $url= explode("/", $url);

        if(isset($url[0])) {

            include "app/Controllers/".$url[0].".php";
            $controller= new $url[0]();
            $method_name=($url[1]);
            if(!empty($url[2])){

               $_parameter=($url[2]);
               $controller->$method_name($_parameter);

            }else{
                if(isset($url[1])){
                    $controller->$method_name();
                }
            }

        }
        }else{
            echo "home page";
        }

    }
}