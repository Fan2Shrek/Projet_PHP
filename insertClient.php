<?php

require 'src/autoloader.php';

use App\Classes\Customer;
use App\Forms\Validator;

$errors = array();

if (isset($_POST['submit'])){
    $customer = new Customer(0,
    rand(0,100),
    $_POST['name'],
    $_POST['notes']);

    $errors = Validator::checkCustomer($customer);
    if (null === $errors){
        $customer->addCustomer();
        header("Location: index.php");
    }
}

?>

<form method='Post'>
    <input name='name' placeholder="Nom">
    <small><?php echo (!isset($errors['notesName']))? '' : $errors['notesName'] ?></small>

    <br>

    <textarea name='notes'></textarea>
    <small><?php echo (!isset($errors['notesError']))? '' : $errors['notesError'] ?></small>
    <button type='submit' name='submit'>Creer</button>
</form>