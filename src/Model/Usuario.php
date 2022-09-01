<?php

namespace Alura\Leilao\Model;

use Alura\Leilao\Exceptions\UsuarioException;

class Usuario
{
    private string $nome;

    public function __construct(string $nome)
    {
        if (empty($nome)) {
            throw new UsuarioException('Nome do usuário é obrigatório');
        }

        $this->nome = $nome;
    }

    public function getNome(): string
    {
        return $this->nome;
    }
}
