<?php
    require "Core/Database.php";
    require "Models/BaseModel.php";
    require "Controllers/BaseController.php";
    require "Helpers/helper.php";
    
    $controller = strtolower($_REQUEST["controller"] ?? "home");
    $controller = str_replace('-', ' ', $controller);
    $controller = ucwords($controller);
    $controller = str_replace(' ', '', $controller);
    $controller.="Controller";

    require "Controllers/{$controller}.php";

    $action = strtolower($_REQUEST["action"] ?? "index");

    //Defined controller Object
    $controllerObj = new $controller;

    //Call controller action
    $controllerObj -> $action();
?>