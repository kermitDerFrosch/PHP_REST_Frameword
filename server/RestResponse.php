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
    public function getContent() {
        return $this->content;
    }

    /**
     * 
     * @return int
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * 
     * @return array
     */
    public function getHeader() {
        return $this->header;
    }

    /**
     * 
     * @param array $content
     */
    public function setContent(array $content) {
        $this->content = $content;
    }

    /**
     * 
     * @param int $code
     */
    public function setCode(int $code) {
        http_response_code($code);
        $this->code = $code;
    }

    /**
     * 
     * @param string $header
     */
    public function addHeader(string $header) {
        $this->header[] = $header;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    /**
     * 
     * @return array
     */
    public function toArray() {
        return [
            "code" => $this->code,
            "msg" => $this->message,
            "data" => $this->content
        ];
    }

}
