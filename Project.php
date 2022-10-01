<?php

require_once 'Customer.php';
require_once 'Host.php';

class Project
{
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

    //id
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    //name
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    //code
    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
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

    //notes
    public function getNotes(): string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
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