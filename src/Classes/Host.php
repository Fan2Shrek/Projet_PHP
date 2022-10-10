<?php

namespace src\Classes;

use src\Traits\IdTrait;
use src\Traits\CodeNotesTrait;
use src\Traits\NameTrait;
use src\Interfaces\CodeNoteInterface;
use src\Interfaces\NameInterface;
use src\Interfaces\IdInterface;

class Host implements IdInterface, nameInterface, codeNoteInterface{
    use idTrait, NameTrait, codeNotesTrait;
    public function __construct(
        private int $id,
        private string $name,
        private string $code,
        private string $notes,
    )
    {
    }
}