<?php

class httpException extends Exception
{
    protected $httpMessages = 
            [
                400 => 'Bad Reqest',
                404 => 'Not Found',
                403 => 'Forbidden'
            ];
    public function __construct(int $code = 0, string $message = "") 
            {
                parent::__construct($message, $code);
            }
    public function sendHttpState()
            {
                //logger->log($this->getMessage());
                header('HTTP/1.0 '.$this->getCode() . ' ' . $this->httpMessages[$this->getCode()]);
            } 
}