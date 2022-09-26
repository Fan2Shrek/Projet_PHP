<?php

require_once 'Project.php';

class Environnement
{
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

    //id
    private function getId(): int
    {
        return $this->id;
    }

    private function setId(int $id): void
    {
        $this->id = $id;
    }

    //name
    private function getName(): string
    {
        return $this->name;
    }
    
    private function setName(string $name): void
    {
        $this->name = $name;
    }

    //link
    private function getLink(): string
    {
        return $this->link;
    }
    
    private function setLink(string $link): void
    {
        $this->link = $link;
    }

    //ip_address
    private function getIp_address(): string
    {
        return $this->ip_address;
    }
    
    private function setIp_address(string $ip_address): void
    {
        $this->link = $ip_address;
    }

    //ssh_port
    private function getSsh_port(): int
    {
        return $this->ssh_port;
    }
    
    private function setSsh_port(int $ssh_port): void
    {
        $this->link = $ssh_port;
    }

    //ssh_username
    private function getSsh_username(): string
    {
        return $this->ssh_username;
    }
    
    private function setSsh_username(string $ssh_username): void
    {
        $this->link = $ssh_username;
    }

    //phpmyadmin_link
    private function getPhpmyadmin_link(): string
    {
        return $this->phpmyadmin_link;
    }
    
    private function setPhpmyadmin_link(string $phpmyadmin_link): void
    {
        $this->link = $phpmyadmin_link;
    }

    //ip_restriction
    private function getIp_restriction(): int
    {
        return $this->ip_restriction;
    }
    
    private function setIp_restriction(int $ip_restriction): void
    {
        $this->link = $ip_restriction;
    }

    //project_id
    private function getProject_id(): Project
    {
        return $this->project_id;
    }
    
    private function setProject_id(int $project_id): void
    {
        $this->link = $project_id;
    }
}