<?php

namespace server\entrys;

use \server\RestEntry;
use \server\RestAPI;

/**
 * Description of LoginEntry
 *
 * @author sascha
 */
class LoginEntry extends RestEntry {

    protected function onGet(): array {
        if (!RestAPI::isLoggedIn()) {
            $this->response->setCode(401);
            $this->response->setMessage("Please login first");
        } else {
            $this->response->setMessage("Already logged in");
        }
        return [];
    }

    protected function onPost(): array {
        $loggedin = false;
        foreach ($this->request->getHeader() as $key => $line) {
// TODO 
            if (strtolower($key) === "meldmichan") {
                $loggedin = true;
            }
        }
        
        if ($loggedin) {
            $_SESSION["loggedIn"] = true;
            $_SESSION["clientIp"] = getRemoteAddr();
        }
        $content = $this->request->getContent();
        $content["loggedIn"] = $loggedin;
        return $content;
    }

}
