<?php 

require '../vendor/autoload.php';

use App\Classes\Contact;
use App\Repository\ContactRepository;
use App\Repository\CustomerRepository;
use App\Repository\HostRepository;
use App\Forms\Validator;
use slugifier as s;

//sécurité
function verifyInput($var){
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

$host = $customer = null;

$new = false;

if (isset($_GET['type']) && $_GET['id'] != 0){
    if (isset($_GET['id']) &&  $_GET['type'] == 'H'){
        $host = HostRepository::getHostById($_GET["id"]);
    }
    elseif (isset($_GET['id']) &&  $_GET['type'] == 'C'){
        $customer = CustomerRepository::getCustomerById($_GET["id"]);
    }
}

if (isset($_POST['submit'])){
    if (isset($_POST['list'])){
        if  ($_GET['type'] == 'C'){
            $customer = CustomerRepository::getCustomerById($_POST['list']);
        }
        elseif ($_GET['type'] == 'H'){
            $host = HostRepository::getHostById($_POST['list']);
        }
    }
    $contact = new Contact(
        0,
        verifyInput($_POST['name']),
        verifyInput($_POST['email']),
        verifyInput($_POST['phone_number']),
        verifyInput($_POST['role']),
        $customer,
        $host,
    );
    $errors = Validator::checkContact($contact);
    if (null === $errors){
        ContactRepository::addContact($contact);
        if ($_GET['id'] != 0){
            header("Location: ".$_GET['type']."-".$_GET['id'].'-1');
        }
        else{
            header("Location: ".$_GET['type']."-".$_POST['list'].'-1');
        }
    }
}

if ($_GET['id'] == 0){
    $new = true;
    $list = ($_GET['type'] == 'C') ? CustomerRepository::getCustomer():HostRepository::getHost();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <base href='../'>
        <title>Modifier un contact</title>
        <base href="../">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="public/js/script.js"></script>
        <link rel="stylesheet" href="public/css/styles.css">
    </head>
    
    <body>

    <body>
        
        <?php require '../layout/navbar.php' ?>
        
        <section id="update">

            <div class="container-fluid">
                <div class="row">

                    <!-- menu -->                 
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <?php require '../layout/menu.php' ?>
                    </div>

                    <!-- titre -->
                    <div class="col-lg-9 col-md-9 col-sm-12">

                        <!-- lien -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h2 class="nouv"><?php  if (!$new)echo isset($host) ? $host->getName() : $customer->getName()?></h2>
                            <ul class="listContact">
                                <a href='Host/<?php echo $_GET['id']?>' class="infoGenerale">INFORMATIONS GÉNÉRALES</a>&emsp;
                                <a href="Contact/<?php echo $_GET['id']?>" class="contactLien">CONTACTS CLIENT</a>
                            </ul>
                        </div>

                        <!-- debut carré -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="addContact">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <form method="Post">  

                                        <div class="contactAffichage">
                                            <h3 class="nomContact">Nouveau contact</h3>

                                            <div class='group-form'>
                                                <label for='name'>Nom : </label>
                                                <input name="name" class="AddClient" value="<?php echo $_POST['name'] ?? '' ?>">
                                                <p class="error"><?php echo $errors['nameError'] ?? '' ?></p>
                                            </div>
                                            <br>

                                            <div class='group-form'>
                                                <label class="lab">Email : </label>
                                                <input name='email' size="30" class="UpClient" value="<?php echo $_POST['email'] ?? '' ?>">
                                                <p class="error"><?php echo $errors['emailError'] ?? '' ?></p>
                                            </div>

                                            <br>                                                

                                            <br> <br>
                                            <div class='form-right'>

                                                <div class='group-form' id='role-form'>
                                                    <label class="lab2">Role : </label>
                                                    <input type='text' name="role" class="AddClient2"><?php echo $_POST['role'] ?? '' ?></textarea>
                                                </div>

                                                <div class='group-form'>
                                                    <label class="lab">Telephone : </label>
                                                    <input size="30" name='phone_number' class="UpClient" value="<?php echo $_POST['phone_number'] ?? '' ?>"> 
                                                </div>
                                            </div>

                                            
                                                <?php
                                                    if (isset($list)){
                                                        echo "<select name='list'>";
                                                        foreach ($list as $obj){
                                                            echo '<option value='.$obj->getId().'>'.$obj->getName().'</option>';
                                                        }
                                                        echo "</select>";
                                                    }
            
                                                ?>
                                        </div>
                                        <button type="submit" name="submit" class="btnOrange" style='margin-top: 10px'><span class="glyphicon glyphicon-ok"></span> Ajouter</button>&emsp;

                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </section>
    
        <?php require '../layout/footer.php' ?>
        
    </body>

</html>