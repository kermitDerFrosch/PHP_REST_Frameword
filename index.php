<?php
function autoload($class) {
    $filename = str_replace("\\", "/", $class).".php";
    if (file_exists($filename)) {
        require_once $filename;
    }
}


spl_autoload_register("autoload");


use server\RestAPI;


$api = new RestAPI();

