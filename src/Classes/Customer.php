<?php

namespace src\Classes;

use src\Traits\IdTrait;
use src\Traits\CodeNotesTrait;
use src\Traits\NameTrait;
use src\Interfaces\CodeNoteInterface;
use src\Interfaces\NameInterface;
use src\Interfaces\IdInterface;
use src\Form\Connection;

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
    
    /*
    public function addCustomer(): bool{
        try{
            $database = Database::connect();
            $statement = $database.prepare('INSERT INTO customer VALUES (=:code, =:name, =:notes)');
            $statement->bindParam(':code', $this->code);
            $statement->bindParam(':name', $this->name);
            $statement->bindParam(':notes', $this->notes);
            $statement.execute();
            return true;
        }catch (Exception $e)
        {
            return false;
        }
    }*/
}   