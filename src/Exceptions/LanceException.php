<?php

namespace Alura\Leilao\Exceptions;

class LanceException extends \Exception
{
    public function __construct(string $message)
    {
        $this->message = $message;
    }
}
