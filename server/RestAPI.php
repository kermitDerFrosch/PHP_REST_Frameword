<?php

/**
 * Description of RestAPI
 *
 * @author sascha
 */

namespace server;

use \Exception;

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
     * @var double
     */
    public static $startTime;

    /**
     *
     * @var bool
     */
    public static $devMode = false;

    public function __construct() {
        session_start();
        self::$startTime = microtime(true);
        $this->request = new RestRequest();
        $this->response = new RestResponse();
        $this->response->addHeader("Content-type: application/json; charset: utf-8");
        $entryName = filter_input(INPUT_GET, "_rest__entry", FILTER_SANITIZE_STRING);

        if (!self::isLoggedIn() && $entryName !== "login") {
            $entryName = "Error404";
        } else {
            if (empty($entryName)) {
                $entryName = "Default";
            }
            if (endsWith($entryName, "/")) {
                $entryName = substr($entryName, 0, -1);
            }
            if (!file_exists("server/entrys/" . ucfirst($entryName) . "Entry.php")) {
                $entryName = "Error404";
            }
        }
        $className = "server\\entrys\\" . str_replace("/", "\\", ucfirst($entryName)) . "Entry";

        try {

            $entry = new $className($this->request, $this->response);
            unset($entry);
        } catch (Exception $e) {
            $entry = new entrys\Error404Entry($this->request, $this->response, $e->getMessage());
        }
    }

    public static function isLoggedIn(): bool {
        if (self::$devMode) {
            return true;
        }
        $loggedIn = array_key_exists("loggedIn", $_SESSION) && $_SESSION["loggedIn"] === true;
        $validClientIp = array_key_exists("clientIp", $_SESSION) && $_SESSION["clientIp"] === getRemoteAddr();
        return $loggedIn && $validClientIp;
    }

    public function __destruct() {
        $this->setHeader();
        $this->printResponseData();
    }

    private function printResponseData(): void {
        $data = json_encode($this->response->toArray());
        if (!$data) {
            throw new Exception("something went wrong");
        }
        echo $data;
    }

    private function setHeader(): void {
        $header = $this->response->getHeader();
        foreach ($header as $line) {
            header($line);
        }
    }

    public static function getDuration(): string {
        return number_format(microtime(true) - RestAPI::$startTime, 5);
    }

}
