<?php

namespace Alura\Leilao\Tests\Models;

use Alura\Leilao\Exceptions\UsuarioException;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class UsuarioTest extends TestCase
{
    public function testNomeEhObrigatorio()
    {
        $this->expectException(UsuarioException::class);
        $this->expectExceptionMessage('Nome do usuário é obrigatório');

        new Usuario('');
    }
}
