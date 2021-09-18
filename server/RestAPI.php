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

    public function __construct() {
        $this->request = new RestRequest();
        $this->response = new RestResponse();
        $this->response->addHeader("Content-type: application/json; charset: utf-8");
        $entryName = filter_input(INPUT_GET, "entry", FILTER_SANITIZE_STRING);
        if (empty($entryName)) {
            $entryName = "Default";
        }
        if (!file_exists("server/entrys/".ucfirst($entryName)."Entry.php")) {
            $entryName = "Error404";
        }
        $className = "server\\entrys\\".ucfirst($entryName)."Entry";
        $entry = new $className($this->request, $this->response);
        
        
        $this->setHeader();
        $this->printResponseData();
    }
    
    public function printResponseData(): void {
        $data = json_encode($this->response->toArray());
        if (!$data) {
            throw new Exception("something went wrong");
        }
        echo $data;
    }
    
    private function setHeader() {
        $header = $this->response->getHeader();
        foreach ($header as $line) {
            header($line);
        }
    }

}
