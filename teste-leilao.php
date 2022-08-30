<?php

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

require 'vendor/autoload.php';

// criar leilao
$leilao = new Leilao('Fiat 147 0KM');

// criar usuarios
$joao = new Usuario('João');
$maria = new Usuario('Maria');

// associar lances dos usuários ao leilão
$leilao->recebeLance(new Lance($joao, 2000));
$leilao->recebeLance(new Lance($maria, 2500));

// leiloeiro avalia e obtem o maior valor
$leiloeiro = new Avaliador();
$leiloeiro->avalia($leilao);

// compara o maior valor do lance e exibe se teste está OK ou se falhou
$maiorValor = $leiloeiro->getMaiorValor();

$valorEsperado = 2500;

if ($valorEsperado == $maiorValor) {
    echo "TESTE OK";
} else {
    echo "TESTE FALHOU!!!";
}

