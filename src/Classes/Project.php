<?php

namespace src\Classes;

use src\Interfaces\IdInterface;
use src\Interfaces\nameInterface;
use src\Interfaces\codeNoteInterface;
use src\Traits\codeNotesTrait;
use src\Traits\idTrait;
use src\Traits\NameTrait;
use src\Classes\Customer;
use src\Classes\Host;

class Project implements IdInterface, nameInterface, codeNoteInterface
{
    use idTrait, NameTrait, codeNotesTrait;
    public function __construct
    (
        private int $id,
        private string $name,
        private string $code,
        private string $lastpast_folder,
        private string $link_mock_ups,
        private int $managed_server,
        private string $notes,
        private Host $host_id,
        private Customer $customer_id
    )
    {
    }

    //lastpast_folder
    public function getLastpast_folder(): string
    {
        return $this->lastpast_folder;
    }

    public function setLastpast_folder(string $lastpast_folder): void
    {
        $this->lastpast_folder = $lastpast_folder;
    }

    //link_mock_ups
    public function getLink_mock_ups(): string
    {
        return $this->link_mock_ups;
    }

    public function setLink_mock_ups(string $link_mock_ups): void
    {
        $this->link_mock_ups = $link_mock_ups;
    }

    //managed_server
    public function getManaged_server(): int
    {
        return $this->managed_server;
    }

    public function setManaged_server(int $managed_server): void
    {
        $this->managed_server = $managed_server;
    }

    //host
    public function getHost_id(): Host 
	{
		return $this->host_id;
	}

	public function setHost_id(Host $host_id): void
	{
		$this->host_id = $host_id;
	}

    //customer
	public function getCustomer_id(): Customer 
	{
		return $this->customer_id;
	}

	public function setCustomer_id(Customer $customer_id): void
	{
		$this->customer_id = $customer_id;
	}
}