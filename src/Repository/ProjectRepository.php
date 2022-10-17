<?php

namespace App\Repository;

use App\Classes\Project;
use App\Database\Connection;
use App\Repository\HostRepository;
use App\Repository\CustomerRepository;


class ProjectRepository{

    //select id
    public static function getProjectById(int $id): ?Project{
        $database = Connection::connect();
        $statement = $database->prepare('SELECT * FROM project WHERE id = ?');
        $statement->execute(array($id));
        $rep = $statement->fetch();

        $host = HostRepository::getHostById($rep['host']);
        $customer = CustomerRepository::getCustomerById($rep['customer']);

        $pro = ($rep) ? new Project($id, $rep['name'], $rep['code'], 
            $rep['lastpast_folder'], $rep['link_mock_ups'], 
            $rep['managed_server'], $rep['notes'], 
            $host, $customer) : null;
        $database = Connection::disconnect();
        return $pro;
    }

    //select *
    public static function getProjects() : array{
        $rep = array();
        $database = Connection::connect();
        $statement = $database->prepare('SELECT * FROM project');
        $statement->execute();
        while($cus = $statement->fetch()){
            $host = HostRepository::getHostById($rep['host']);
            $customer = CustomerRepository::getCustomerById($rep['customer']);
            $temp = 
            new Project($rep['id'], $rep['name'], $rep['code'], 
                $rep['lastpast_folder'], $rep['link_mock_ups'], 
                $rep['managed_server'], $rep['notes'], 
                $host, $customer);
            $rep[] = $temp;
        }
        $database = Connection::disconnect();
        return $rep;
    }

    //insert
    public static function addProject(Project $project): void{
        $database = Connection::connect();
        $statement = $database->prepare('INSERT INTO project (name, code, lastpast_folder, link_mock_ups, 
            managed_server, notes, host_id, customer_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $statement->execute(array($project->getName(), $project->getCode(), 
            $project->getLastpast_folder(), $project->getLink_mock_ups(), 
            $project->getManaged_server(), $project->getNotes(), $project->getHost()->getId(), 
            $project->getCustomer()->getId()));
        $database = Connection::disconnect();
    }

    //update
    public static function updateProject (Project $oldPro, Project $newPro): void{
        $database = Connection::connect();
        $statement = $database->prepare('UPDATE project set name=? , code=?, lastpast_folder=?, 
            link_mock_ups=?, managed_server=?, notes=?, host_id=?, customer_id=?) 
            WHERE id = ?');
        $statement->execute(array($newPro->getName(), $newPro->getCode(), 
            $newPro->getLastpast_folder(), $newPro->getLink_mock_ups(), 
            $newPro->getManaged_server(), $newPro->getNotes(), $newPro->getHost()->getId(), 
            $newPro->getCustomer()->getId(), 
            $oldPro->getId()));
        $database = Connection::disconnect();
    }

    //delete
    public static function deleteProject(Project $project): void{
        $database = Connection::connect();
        $statement = $database->prepare('DELETE from project WHERE id = ?');
        $statement->execute(array($project->getId()));
        $database = Connection::disconnect();
    }
}