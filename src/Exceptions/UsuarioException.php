<?php

namespace Alura\Leilao\Exceptions;

class UsuarioException extends \Exception
{
    public function __construct(string $message)
    {
        $this->message = $message;
    }
}
