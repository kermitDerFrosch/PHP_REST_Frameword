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
        $this->method = strtoupper($_SERVER["REQUEST_METHOD"]);
        $this->header = apache_request_headers();
        
    }
    
    /**
     * 
     * @return array
     */
    public function getContent() : array {
        return $this->content;
    }

    /**
     * 
     * @return string
     */
    public function getMethod() : string {
        return $this->method;
    }

    /**
     * 
     * @return array
     */
    public function getHeader() : array {
        return $this->header;
    }


}
