<?php

namespace Alura\Leilao\Tests\Models;

use Alura\Leilao\Exceptions\LeilaoException;
use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
    public function testLeilaoNaoDeveAceitarMaisDe5LancesRepetidosPorUsuario()
    {
        $this->expectException(LeilaoException::class);
        $this->expectExceptionMessage('Usuário não pode realizar mais de 5 lances.');

        $leilao = new Leilao('Brasília Amarela');
        $ana = new Usuario('Ana');
        $maria = new Usuario('Maria');

        $leilao->recebeLance(new Lance($ana, 1000));
        $leilao->recebeLance(new Lance($maria, 2000));
        $leilao->recebeLance(new Lance($ana, 3000));
        $leilao->recebeLance(new Lance($maria, 4000));
        $leilao->recebeLance(new Lance($ana, 5000));
        $leilao->recebeLance(new Lance($maria, 6000));
        $leilao->recebeLance(new Lance($ana, 7000));
        $leilao->recebeLance(new Lance($maria, 8000));
        $leilao->recebeLance(new Lance($ana, 9000));
        $leilao->recebeLance(new Lance($maria, 10000));

        $leilao->recebeLance(new Lance($ana, 10500));
    }
    
    public function testLeilaoNaoDeveReceberLancesRepetidos()
    {
        $this->expectException(LeilaoException::class);
        $this->expectExceptionMessage('Usuário não pode realizar lances consecutivos.');

        $ana = new Usuario('Ana');

        $leilao = new Leilao('Variante 0KM');
        $leilao->recebeLance(new Lance($ana, 1000));
        $leilao->recebeLance(new Lance($ana, 2000));
    }
    
    /**
     * @dataProvider geraLances()
     */
    public function testLeilaoDeveReceberLances(
        int $qtdLances,
        Leilao $leilao,
        array $valores
    ) {
        $this->assertCount($qtdLances, $leilao->getLances());

        foreach ($valores as $i => $valorEsperado) {
            $this->assertEquals($valorEsperado, $leilao->getLances()[$i]->getValor());
        }
    }

    public function geraLances(): array
    {
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');

        $leilaoCom2Lances = new Leilao('Fiat 147 0KM');
        $leilaoCom2Lances->recebeLance(new Lance($joao, 1000));
        $leilaoCom2Lances->recebeLance(new Lance($maria, 2000));

        $leilaoCom1Lance = new Leilao('Fusca 1972 0KM');
        $leilaoCom1Lance->recebeLance(new Lance($maria, 5000));

        return [
            '2-lances' => [2, $leilaoCom2Lances, [1000, 2000]],
            '1-lance' => [1, $leilaoCom1Lance, [5000]],
        ];
    }
}
