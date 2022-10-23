<?php

namespace App\Repository;

use App\Classes\Contact;
use App\Database\Connection;
use App\Repository\HostRepository;
use App\Repository\CustomerRepository;

class ContactRepository{

    //select id
    public static function getContactById(int $id): ?Contact{
        $database = Connection::connect();
        $statement = $database->prepare('SELECT * FROM contact WHERE id = ?');
        $statement->execute(array($id));
        $rep = $statement->fetch();
        $cus = ($rep) ? new Contact($id, $rep['email'], $rep['phone_number'], $rep['role']) : null;
        $database = Connection::disconnect();
        return $cus;
    }

    //select *
    public static function getContact() : array{
        $rep = array();
        $database = Connection::connect();
        $statement = $database->prepare('SELECT * FROM contact');
        $statement->execute();
        $database = Connection::disconnect();
        while($con = $statement->fetch()){
            if (null === $con['host_id']){
                $temp = new Contact($con['id'], $con['email'], $con['phone_number'], $con['role'], customer:CustomerRepository::getCustomerById($con['customer_id']));
                $rep[] = $temp;
            }else{
                $temp = new Contact($con['id'], $con['email'], $con['phone_number'], $con['role'], host : HostRepository::getHostById($con['host_id']));
                $rep[] = $temp;
            }

        }
        return $rep;
    }

    //insert
    public static function addContact(Contact $contact): void{
        $database = Connection::connect();
        $statement = $database->prepare('INSERT INTO contact (email, phone_number, role) VALUES (?, ?, ?)');
        $statement->execute(array($contact->getEmail(), $contact->getPhone(), $contact->getRole()));
        $database = Connection::disconnect();
    }

    //update
    public static function updateContact(Contact $oldCon, Contact $newCon): void{
        $database = Connection::connect();
        $statement = $database->prepare ('UPDATE customer set email = ?, phone_number = ?, 
        role = ? WHERE id= ?');
        $statement->execute(array($newCon->getEmail(), $newCon->getPhone(), 
        $newCon->getRole(), $oldCon->getId()));
        $database = Connection::disconnect();
    }

    //delete
    public static function deleteContact(Contact $contact): void{
        $database = Connection::connect();
        $statement = $database->prepare('DELETE from contact WHERE id = ?');
        $statement->execute(array($contact->getId()));
        $database = Connection::disconnect();
    }
}