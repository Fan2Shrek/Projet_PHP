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
    
    public function addCustomer(): void{
        $database = Connection::connect();
        $statement = $database->prepare('INSERT INTO customer (code, name, notes) VALUES (?, ?, ?)');
        $statement->bindParam(1, $this->code);
        $statement->bindParam(2, $this->name);
        $statement->bindParam(3, $this->notes);
        $statement->execute();
    }

    public function UpdateCustomer (Customer $newCus): void{
        $database = Connection::connect();
        $statement = $database->prepare ('UPDATE customer set code = ? , name = ?, notes = ? WHERE id= ?');
        $statement->bindParam(1, $newCus->getCode());
        $statement->bindParam(2, $newCus->getName());
        $statement->bindParam(3, $newCus->getNotes());
        $statement->bindParam(4, $this->id);
        $statement->execute();
    }
}