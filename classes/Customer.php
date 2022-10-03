<?php

require_once 'traits/idTrait.php';
require_once 'interfaces/idInterface.php';

require_once 'traits/nameTrait.php';
require_once 'interfaces/nameInterface.php';

require_once 'traits/codeNotesTrait.php';
require_once 'interfaces/codeNoteInterface.php';

class Customer implements IdInterface, nameInterface, codeNoteInterface{
    use idTrait, NameTrait, codeNameTrait;
    public function __construct(
        private int $id,
        private string $code,
        private string $name,
        private string $notes,
    )
    {
    }
}