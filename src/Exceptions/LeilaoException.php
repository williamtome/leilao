<?php

namespace Alura\Leilao\Exceptions;

class LeilaoException extends \Exception
{
    /**
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }
}