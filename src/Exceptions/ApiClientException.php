<?php namespace Rtbs\ApiHelper\Exceptions;

use Throwable;

class ApiClientException extends \Exception {

    private $api_error_code;

    public function __construct($message = "", $api_error_code = '', Throwable $previous = null) {
        parent::__construct($message, 0, $previous);
        $this->api_error_code = $api_error_code;
    }
    
    public function getApiErrorCode() {
        return $this->api_error_code;
    }

}