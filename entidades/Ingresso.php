<?php

class Ingresso
{
    private ?string $id;
    private string $cpf;
    private string $id_ingresso;
    private string $id_evento;
    private int $quantidade;
    private int $status;

    public function __construct(
        string $cpf,
        string $id_evento,
        int $quantidade,
        int $status = 1,
    ) {
        if (trim($cpf) === "") {
            throw new InvalidArgumentException("CPF é obrigatório");
        }

        if (trim($id_evento) === "") {
            throw new InvalidArgumentException("ID do evento é obrigatório");
        }
        if ($quantidade <= 0) {
            throw new InvalidArgumentException("Quantidade é obrigatória");
        }

        $this->id = null;
        $this->cpf = $cpf;
        $this->id_evento = $id_evento;
        $this->id_ingresso = $this->setCodQR($cpf, $id_evento);
        $this->quantidade = $quantidade;
        $this->status = $status;
    }

    protected function setCodQR(string $cpf, string $id_evento)
    {
        return $this->id_ingresso = hash("sha256", $cpf . ":" . $id_evento);
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getIdIngresso(): string
    {
        return $this->id_ingresso;
    }
    public function getIdEvento(): string
    {
        return $this->id_evento;
    }
    public function getQtde(): int
    {
        return $this->quantidade;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public static function fromDatabase(
        string $id,
        string $cpf,
        string $id_ingresso,
        string $id_evento,
        int $quantidade,
        int $status,
    ): self {
        $Ingresso = new self(
            $cpf,
            $id_evento,
            $quantidade,
        );

        $Ingresso->id = $id;
        $Ingresso->id_ingresso = $id_ingresso;
        $Ingresso->status = $status;

        return $Ingresso;
    }
}
