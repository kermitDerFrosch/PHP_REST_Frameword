<?php

namespace server;

/**
 * Description of RestRequest
 *
 * @author sascha
 */
class RestRequest {
    private $content;
    private $method;
    private $header;

    public function __construct() {
        switch (strtoupper($_SERVER["REQUEST_METHOD"])) {
            case "GET":
                break;
            case "POST":
            case "PUT":
            case "DELETE":
                $this->content = json_decode(file_get_contents("php://stdin"), true);
                if (!$this->content) {
                    throw new Exception("unknown input");
                }
                break;
            default:
                throw new Exception("Unknown method ".$_SERVER["REQUEST_METHOD"]);
        }
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->header = apache_request_headers();
        
    }
    public function getContent() {
        return $this->content;
    }

    public function getMethod() {
        return $this->method;
    }

    public function getHeader() {
        return $this->header;
    }


}
