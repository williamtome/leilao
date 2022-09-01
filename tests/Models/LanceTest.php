<?php

namespace Alura\Leilao\Tests\Models;

use Alura\Leilao\Exceptions\LanceException;
use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LanceTest extends TestCase
{
    public function testLancarExcessaoSeLanceEhFeitoComValorZero()
    {
        $this->expectException(LanceException::class);
        $this->expectExceptionMessage('Lance não pode ser feito com valor zero.');

        new Lance(new Usuario('Marcos'), 0);
    }

    public function testLancarExcessaoSeLanceEhFeitoComValoresNegativos()
    {
        $this->expectException(LanceException::class);
        $this->expectExceptionMessage('Lance não pode ser feito com valores negativos.');

        new Lance(new Usuario('Marcos'), -250.5);
    }
}
