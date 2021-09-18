<?php

namespace server\entrys;

use \server\RestEntry;

/**
 * Description of DefaultEntry
 *
 * @author sascha
 */
class DefaultEntry extends RestEntry {

    protected function onGet() {
        return [
            "GET" => $_GET,
            "POST" => $_POST,
        ];
    }

}
