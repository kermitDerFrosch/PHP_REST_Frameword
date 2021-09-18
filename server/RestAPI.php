<?php

/**
 * Description of RestAPI
 *
 * @author sascha
 */

namespace server;

use \server\entrys\DefaultEntry;

class RestAPI {

    /**
     *
     * @var RestRequest
     */
    private $request;
    
    /**
     *
     * @var RestResponse
     */
    private $response;

    /**
     *
     * @var int
     */
    private $startTime;
    
    public static $duraion;
    
    public function __construct() {
        $this->startTime = microtime(true);
        $this->request = new RestRequest();
        $this->response = new RestResponse();
        $this->response->addHeader("Content-type: application/json; charset: utf-8");
        $entryName = filter_input(INPUT_GET, "_rest__entry", FILTER_SANITIZE_STRING);
        if (empty($entryName)) {
            $entryName = "Default";
        }
        if (endsWith($entryName, "/")) {
            $entryName = substr($entryName, 0, -1);
        }
        if (!file_exists("server/entrys/".ucfirst($entryName)."Entry.php")) {
            $entryName = "Error404";
        }
        $className = "server\\entrys\\". str_replace("/", "\\", ucfirst($entryName))."Entry";
        
        $entry = new $className($this->request, $this->response);
        unset($entry);
        
        $this->setHeader();
        self::$duraion = microtime(true) - $this->startTime;
        $this->printResponseData();
    }
    
    private function printResponseData(): void {
        $data = json_encode($this->response->toArray());
        if (!$data) {
            throw new Exception("something went wrong");
        }
        echo $data;
    }
    
    private function setHeader() : void {
        $header = $this->response->getHeader();
        foreach ($header as $line) {
            header($line);
        }
    }

}
