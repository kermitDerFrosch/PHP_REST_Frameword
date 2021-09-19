<?php

namespace server;

/**
 * Description of RestResponse
 *
 * @author sascha
 */
class RestResponse {

    /**
     *
     * @var array
     */
    private $content;

    /**
     *
     * @var int
     */
    private $code;

    /**
     *
     * @var array
     */
    private $header;

    /**
     *
     * @var string
     */
    private $message;

    public function __construct() {
        $this->code = 200;
        $this->message = "OK";
        $this->content = [];
    }

    /**
     * 
     * @return array
     */
    public function getContent(): array {
        return $this->content;
    }

    /**
     * 
     * @return int
     */
    public function getCode(): int {
        return $this->code;
    }

    public function getHeader(): array {
        return $this->header;
    }

    /**
     * 
     * @param array $content
     */
    public function setContent(array $content): void {
        $this->content = $content;
    }

    /**
     * 
     * @param int $code
     */
    public function setCode(int $code): void {
        http_response_code($code);
        $this->code = $code;
    }

    /**
     * 
     * @param string $header
     */
    public function addHeader(string $header): void {
        $this->header[] = $header;
    }

    /**
     * 
     * @return string
     */
    public function getMessage(): string {
        return $this->message;
    }

    /**
     * 
     * @param string $message
     * @return void
     */
    public function setMessage(string $message): void {
        $this->message = $message;
    }

    /**
     * 
     * @return array
     */
    public function toArray(): array {
        $rc = [
            "code" => $this->code,
            "msg" => $this->message,
            "data" => empty($this->content) ? null : $this->content,
            "duration" => RestAPI::getDuration() . " s",
        ];
        if (RestAPI::$devMode) {
            $rc["debug"]["GET"] = $_GET;
            $rc["debug"]["COOKIES"] = $_COOKIE;
            $rc["debug"]["SESSION"] = $_SESSION;
            $rc["debug"]["HEAD"] = apache_request_headers();
            $rc["debug"]["SERVER"] = $_SERVER;
        }

        return $rc;
    }

}
