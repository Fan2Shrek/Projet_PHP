<?php

namespace App\Forms;

use App\Classes\Customer;
use App\Classes\Host;
use App\Classes\Project;
use App\Repository\CustomerRepository;
use App\Repository\HostRepository;

function verifyInput($var){
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

class Validator{
    //customer
    public static function checkCustomer(Customer $customer): ?array{
        $rep = array();

        if (null == $customer->getName()){
            $rep ["nameError"] = 'Veuillez renseigner un nom';
        }

        return (empty($rep))? null : $rep;
    }

    //host
    public static function checkHost(Host $host): ?array{
        $rep = array();

        if (null == $host->getName()){
            $rep ["nameError"] = 'Veuillez renseigner un nom';
        }

        return (empty($rep))? null : $rep;
    }

    //project
    public static function checkProjet(Project $project): ?array{
        $rep = array();

        if (null == $project->getName()){
            $rep ["nameError"] = 'Veuillez renseigner un nom';
        }

        if (null == HostRepository::getHostById($project->getHost()->getId())){
            $rep ["hostError"] = 'Veuillez renseigner un hebergeur';
        }

        if (null == CustomerRepository::getCustomerById($project->getCustomer()->getId())){
            $rep ["customerError"] = 'Veuillez renseigner un client';
        }

        return (empty($rep))? null : $rep;
    }
}