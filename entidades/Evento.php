<?php

class Evento
{
    private ?string $id;
    private string $nomeEvento;
    private string $responsavel;
    private int $status;
    private bool $active;
    private string $dataEvento;
    private string $dataEventoFim;
    private string $endereco;

    public function __construct(
        string $nomeEvento,
        string $responsavel,
        string $dataEvento,
        string $dataEventoFim,
        string $endereco,
        bool $active = true,
        int $status = 1,
    ) {
        if (trim($nomeEvento) === "") {
            throw new InvalidArgumentException("Nome do evento é obrigatório");
        }
        if (trim($responsavel) === "") {
            throw new InvalidArgumentException(
                "Responsável do evento é obrigatório",
            );
        }
        if (trim($dataEvento) === "") {
            throw new InvalidArgumentException("Data do evento é obrigatória");
        }
        if (trim($dataEventoFim) === "") {
            throw new InvalidArgumentException(
                "Data final do evento é obrigatória",
            );
        }
        if (trim($endereco) === "") {
            throw new InvalidArgumentException(
                "Endereço do evento é obrigatória",
            );
        }

        $this->nomeEvento = $nomeEvento;
        $this->responsavel = $responsavel;
        $this->status = $status;
        $this->active = $active;
        $this->dataEvento = $dataEvento;
        $this->dataEventoFim = $dataEventoFim;
        $this->endereco = $endereco;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getNomeEvento(): string
    {
        return $this->nomeEvento;
    }
    public function getNomeResponsavel(): string
    {
        return $this->responsavel;
    }
    public function getDataEvento(): string
    {
        return $this->dataEvento;
    }
    public function getDataEventoFim(): string
    {
        return $this->dataEventoFim;
    }
    public function getEndereco(): string
    {
        return $this->endereco;
    }
    public function getAtivo(): string
    {
        return $this->active;
    }
    public function getStatus(): string
    {
        return $this->status;
    }
}
