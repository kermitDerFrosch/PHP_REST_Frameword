<?php
function autoload($class) {
    $filename = str_replace("\\", DIRECTORY_SEPARATOR, $class).".php";
    if (file_exists($filename)) {
        require_once $filename;
    }
}

function endsWith( $haystack, $needle ) {
    $length = strlen( $needle );
    if( !$length ) {
        return true;
    }
    return substr( $haystack, -$length ) === $needle;
}

spl_autoload_register("autoload");


use server\RestAPI;


$api = new RestAPI();
unset($api);

