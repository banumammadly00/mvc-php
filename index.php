<?php
function __autoload($name){
    include_once "system/$name.php";
}
define("SITE_URL", "/mvc-test");
include_once "app/Controllers/Base.php";
include_once "upload.php";
// include_once "system/Form.php";
// include_once "system/Load.php";
// include_once "system/Model.php";
// include_once "system/Route.php";
// include_once "system/Session.php";

$route= new Route();


