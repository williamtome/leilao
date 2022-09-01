<?php

namespace Alura\Leilao\Model;

use Alura\Leilao\Exceptions\LanceException;

class  Lance
{
    /** @var Usuario */
    private $usuario;

    /** @var float */
    private $valor;

    public function __construct(Usuario $usuario, float $valor)
    {
        if ($valor == 0) {
            throw new LanceException('Lance não pode ser feito com valor zero.');
        }

        if ($valor < 0) {
            throw new LanceException('Lance não pode ser feito com valores negativos.');
        }

        $this->usuario = $usuario;
        $this->valor = $valor;
    }

    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    public function getValor(): float
    {
        return $this->valor;
    }
}
