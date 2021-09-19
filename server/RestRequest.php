<?php

namespace server;
use \Exception;
/**
 * Description of RestRequest
 *
 * @author sascha
 */
class RestRequest {
    private $content = [];
    private $method = "GET";
    private $header;

    public function __construct() {
        $content = json_decode(file_get_contents("php://stdin"), true);
        if ($content) {
            $this->content = $content;
        }
        $this->method = strtoupper($_SERVER["REQUEST_METHOD"]);
        $this->header = apache_request_headers();
    }
    
    /**
     * 
     * @return array
     */
    public function getContent() : array {
        if (!is_array($this->content)) {
            return [];
        }
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
