<?php

namespace Alura\Leilao\Model;

use Alura\Leilao\Exceptions\LeilaoException;

class Leilao
{
    private array $lances;

    private string $descricao;

    private bool $finalizado;

    public function __construct(string $descricao)
    {
        $this->finalizado = false;
        $this->descricao = $descricao;
        $this->lances = [];
    }

    /**
     * @throws LeilaoException
     *
     * @return void
     */
    public function recebeLance(Lance $lance)
    {
        if (!empty($this->lances) && $this->ehDoUltimoUsuario($lance)) {
            throw new LeilaoException('Usuário não pode realizar lances consecutivos.');
        }

        $usuario = $lance->getUsuario();
        $totalDeLances = $this->getTotalDeLancesPor($usuario);

        if ($totalDeLances >= 5) {
            throw new LeilaoException('Usuário não pode realizar mais de 5 lances.');
        }

        $this->lances[] = $lance;
    }

    /**
     * @return Lance[]
     */
    public function getLances(): array
    {
        return $this->lances;
    }

    public function finaliza(): void
    {
        $this->finalizado = true;
    }

    public function estaFinalizado(): bool
    {
        return $this->finalizado;
    }

    /**
     * @param Lance $lance
     * @return bool
     */
    public function ehDoUltimoUsuario(Lance $lance): bool
    {
        $ultimoLance = $this->lances[array_key_last($this->lances)];

        return $ultimoLance->getUsuario() === $lance->getUsuario();
    }

    /**
     * @param Usuario $usuario
     * @return int
     */
    private function getTotalDeLancesPor(Usuario $usuario): int
    {
        $callback = function ($valorAnterior, $valorAtual) use ($usuario) {
            return $valorAtual->getUsuario() === $usuario
                ? $valorAnterior += 1
                : $valorAnterior;
        };

        return array_reduce($this->lances, $callback,0);
    }
}
