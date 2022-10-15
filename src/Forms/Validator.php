<?php

namespace App\Forms;

use App\Classes\Customer;

class Validator{
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
}