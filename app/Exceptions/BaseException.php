<?php

namespace App\Exceptions;

use App\Traits\ResponseBuilder;

class BaseException extends \Exception
{
    use ResponseBuilder;

    protected $context = [];
    protected $errorCode;
    protected $body;

    public function __construct($httpStatus, $errorCode = null, $errorMessage = null, $body = [])
    {
        $this->errorCode = $errorCode;
        $this->body = $body;

        parent::__construct($errorMessage, $httpStatus);
    }

    public function context()
    {
        return $this->context;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function render()
    {
        return $this->error($this->getMessage(), $this->getCode(), $this->getBody());
    }
}
