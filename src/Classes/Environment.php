<?php

namespace src\Classes;

use src\Interfaces\IdInterface;
use src\Interfaces\NameInterface;
use src\Traits\IdTrait;
use src\Traits\NameTrait;
use src\Classes\Project;

class Environment implements IdInterface, nameInterface
{
    use idTrait, NameTrait;
    public function __construct
    (
        private int $id,
        private string $name,
        private string $link,
        private string $ip_address,
        private int $ssh_port,
        private string $ssh_username,
        private string $phpmyadmin_link,
        private int $ip_restriction,
        private Project $project_id
    )
    {
    }
    
    //link
    public function getLink(): string
    {
        return $this->link;
    }
    
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    //ip_address
    public function getIp_address(): string
    {
        return $this->ip_address;
    }
    
    public function setIp_address(string $ip_address): void
    {
        $this->link = $ip_address;
    }

    //ssh_port
    public function getSsh_port(): int
    {
        return $this->ssh_port;
    }
    
    public function setSsh_port(int $ssh_port): void
    {
        $this->link = $ssh_port;
    }

    //ssh_username
    public function getSsh_username(): string
    {
        return $this->ssh_username;
    }
    
    public function setSsh_username(string $ssh_username): void
    {
        $this->link = $ssh_username;
    }

    //phpmyadmin_link
    public function getPhpmyadmin_link(): string
    {
        return $this->phpmyadmin_link;
    }
    
    public function setPhpmyadmin_link(string $phpmyadmin_link): void
    {
        $this->link = $phpmyadmin_link;
    }

    //ip_restriction
    public function getIp_restriction(): int
    {
        return $this->ip_restriction;
    }
    
    public function setIp_restriction(int $ip_restriction): void
    {
        $this->link = $ip_restriction;
    }

    //project_id
    public function getProject_id(): Project
    {
        return $this->project_id;
    }
    
    public function setProject_id(int $project_id): void
    {
        $this->link = $project_id;
    }
}