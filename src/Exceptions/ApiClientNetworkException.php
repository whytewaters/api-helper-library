<?php namespace Rtbs\ApiHelper\Exceptions;

use Throwable;

class ApiClientNetworkException extends \Exception {

    public function __construct($message = "", $code = '', Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}