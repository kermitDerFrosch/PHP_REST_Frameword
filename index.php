<?php

function autoload($class) {
    $filename = str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".php";
    if (file_exists($filename)) {
        require_once $filename;
    }
}

function getRemoteAddr() {
    return !empty($_SERVER['HTTP_X_REMOTECLIENT_IP']) ? $_SERVER['HTTP_X_REMOTECLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
}

function endsWith($haystack, $needle) {
    $length = strlen($needle);
    if (!$length) {
        return true;
    }
    return substr($haystack, -$length) === $needle;
}

function startsWith($haystack, $needle) {
    return strpos($haystack, $needle) === 0;
}

spl_autoload_register("autoload");

use server\RestAPI;

RestAPI::$devMode = true;
// parse API request
$api = new RestAPI();

// print response
unset($api);
