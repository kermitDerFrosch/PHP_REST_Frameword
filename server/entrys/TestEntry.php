<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace server\entrys;

use \server\RestEntry;

/**
 * Description of TestEntry
 *
 * @author sascha
 */
class TestEntry extends RestEntry {

    protected function onGet(): array {
        return [
            "GET" => $_GET,
        ];
    }

    protected function onPost(): array {
        return [
            "GET" => $_GET,
            "content" => $this->request->getContent()
        ];
    }

    protected function onPut(): array {
        return [
            "GET" => $_GET,
            "content" => $this->request->getContent()
        ];
    }

    protected function onDelete(): array {
        return [
            "GET" => $_GET,
            "content" => $this->request->getContent()
        ];
    }

}
