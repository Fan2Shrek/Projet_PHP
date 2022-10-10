<?php

namespace App\Classes;

use App\Traits\IdTrait;
use App\Traits\CodeNotesTrait;
use App\Traits\NameTrait;
use App\Interfaces\CodeNoteInterface;
use App\Interfaces\NameInterface;
use App\Interfaces\IdInterface;
use App\Database\Connection;
use FFI\Exception;

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
    
    public function addCustomer(): bool{
        try{
            $database = Connection::connect();
            $statement = $database->prepare('INSERT INTO customer (code, name, notes) VALUES (?, ?, ?)');
            $statement->bindParam(1, $this->code);
            $statement->bindParam(2, $this->name);
            $statement->bindParam(3, $this->notes);
            $statement->execute();
            return true;
        }catch (Exception $e)
        {
            return false;
        }
    }
}   