<?php

namespace server\entrys;

use \server\RestEntry;

/**
 * Description of DefaultEntry
 *
 * @author sascha
 */
class Error404Entry extends RestEntry {

    public function __construct(\server\RestRequest $request, \server\RestResponse $response) {
        parent::__construct($request, $response);
        $this->response->setCode(404);
        $this->response->setMessage("Not Found");
    }

    protected function onGet() {
        return [
            "GET" => $_GET,
            "POST" => $_POST,
        ];
    }

}
