<?php

namespace App\Repository;

use App\Classes\Customer;
use App\Database\Connection;

class CustomerRepository{
    public static function getCustomerById(int $id): ?Customer{
        $database = Connection::connect();
        $statement = $database->prepare('SELECT * FROM customer WHERE id = ?');
        $statement->execute(array($id));
        $rep = $statement->fetch();
        $cus = ($rep) ? new Customer($id, $rep['code'], $rep['name'], $rep['notes']) : null;
        $database = Connection::disconnect();
        return $cus;
    }

    public static function getCustomers() : array{
        $rep = array();
        $database = Connection::connect();
        $statement = $database->prepare('SELECT * FROM customer');
        $statement->execute();
        $database = Connection::disconnect();
        while($cus = $statement->fetch()){
            $temp = new Customer($cus['id'], $cus['code'], $cus['name'], $cus['notes']);
            $rep[] = $temp;
        }
        return $rep;
    }

    public static function addCustomer(Customer $customer): void{
        $database = Connection::connect();
        $statement = $database->prepare('INSERT INTO customer (code, name, notes) VALUES (?, ?, ?)');
        $statement->execute(array($customer->getCode(), $customer->getName(), $customer->getNotes()));
        $database = Connection::disconnect();
    }

    public static function updateCustomer (Customer $oldCus, Customer $newCus): void{
        $database = Connection::connect();
        $statement = $database->prepare ('UPDATE customer set code = ? , name = ?, notes = ? WHERE id= ?');
        $statement->execute(array($newCus->getCode(), $newCus->getName(), $newCus->getNotes(), $oldCus->getId()));
        $database = Connection::disconnect();
    }

    public static function deleteCustomer(Customer $customer): void{
        $database = Connection::connect();
        $statement = $database->prepare('DELETE from Customer WHERE id = ?');
        $statement->execute(array($customer->id));
        $database = Connection::disconnect();
    }
}