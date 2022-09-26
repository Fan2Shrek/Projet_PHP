<?php

class Host{
    public function __construct(
        private int $id,
        private string $code,
        private string $name,
        private string $notes,
    )
    {
    }

    private function getId(): int{
        return $this->id;
    }

    private function setId(int $id): void{
        $this->id = $id;
    }

    private function getCode(): string{
        return $this->code;
    }

    private function setCode(string $code): void{
        $this->code = $code;
    }

    private function getName(): string{
        return $this->name;
    }

    private function setName(string $name): void{
        $this->name = $name;
    }

    private function getNotes(): string{
        return $this->notes;
    }

    private function setNotes(string $notes): void{
        $this->notes = $notes;
    }
}