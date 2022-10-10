<?php

namespace App\Forms;

use App\Classes\Customer;

class Validator extends Customer{
    public static function checkCustomer(Customer $customer): ?array{
        $rep = array();
        if (null == $customer->getCode()){
            $rep["codeErreur"] = 'Veuillez renseigner un code';
        }

        if (null == $customer->getName()){
            $rep ["nameErreur"] = 'Veuillez renseigner un code';
        }

        if (null == $customer->getNotes()){
            $rep ["notesErreur"] = 'Veuillez renseigner un code';
        }

        return (empty($rep))? null : $rep;
    }
}