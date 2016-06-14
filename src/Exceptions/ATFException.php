<?php

namespace Knox\AFT\Exceptions;

use Exception;

class ATFException extends Exception
{
     
    public function __construct($message)
    {
        parent::__construct($message);
    }

}