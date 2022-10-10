<?php

namespace src\Interfaces;

interface NameInterface{
    public function getName(): string;
    public function setName(string $newName): void; 
}