<?php

namespace src\Classes;

use src\Traits\idTrait;
use src\Traits\codeNotesTrait;
use src\Traits\NameTrait;
use src\Interfaces\codeNoteInterface;
use src\Interfaces\nameInterface;
use src\Interfaces\IdInterface;

class Customer implements IdInterface, nameInterface, codeNoteInterface{
    use idTrait, NameTrait, codeNotesTrait;
    public function __construct(
        private int $id,
        private string $code,
        private string $name,
        private string $notes,
    )
    {
    }
}