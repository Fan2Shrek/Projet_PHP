<?php

namespace App\Forms;

use App\Classes\Customer;
use App\Classes\Host;
use App\Classes\Project;


class Validator{
    //customer
    public static function checkCustomer(Customer $customer): ?array{
        $rep = array();

        if (null == $customer->getName()){
            $rep ["nameError"] = 'Veuillez renseigner un nom';
        }

        if (null == $customer->getNotes()){
            $rep ["notesError"] = 'Veuillez renseigner une note';
        }

        return (empty($rep))? null : $rep;
    }

    //host
    public static function checkHost(Host $host): ?array{
        $rep = array();

        if (null == $host->getName()){
            $rep ["nameError"] = 'Veuillez renseigner un nom';
        }

        if (null == $host->getNotes()){
            $rep ["notesError"] = 'Veuillez renseigner une note';
        }

        return (empty($rep))? null : $rep;
    }

    //project
    public static function checkProjet(Project $project): ?array{
        $rep = array();

        if (null == $project->getName()){
            $rep ["nameError"] = 'Veuillez renseigner un nom';
        }

        if (null == $project->getLastpast_folder()){
            $rep ["lastpast_folderError"] = 'Veuillez renseigner un dossier';
        }

        if (null == $project->getLink_mock_ups()){
            $rep ["link_mock_upsError"] = 'Veuillez renseigner un lien';
        }

        if (null == $project->getNotes()){
            $rep ["notesError"] = 'Veuillez renseigner une note';
        }

        if (null == $project->getHost()){
            $rep ["HostError"] = 'Veuillez renseigner un hebergeur';
        }

        if (null == $project->getCustomer()){
            $rep ["customerError"] = 'Veuillez renseigner un client';
        }

        return (empty($rep))? null : $rep;
    }
}