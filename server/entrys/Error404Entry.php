<?php

namespace server\entrys;

use \server\RestEntry;
use \server\RestAPI;

/**
 * Description of DefaultEntry
 *
 * @author sascha
 */
class Error404Entry extends RestEntry {

    public function __construct(\server\RestRequest &$request, \server\RestResponse &$response, string $message = "not found") {
        parent::__construct($request, $response);
        if (!RestAPI::isLoggedIn()) {
            $this->response->setCode(401);
            $this->response->setMessage("Please login first");
        } else {
            $this->response->setCode(404);
            $this->response->setMessage($message);
        }
    }

    protected function onGet(): array {
        return [];
    }

    protected function onPost(): array {
        return [];
    }

    protected function onPut(): array {
        return [];
    }

    protected function onDelete(): array {
        return [];
    }

}
