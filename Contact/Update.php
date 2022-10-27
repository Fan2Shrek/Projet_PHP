<?php 

require '../vendor/autoload.php';

use App\Classes\Contact;
use App\Repository\ContactRepository;
Use App\Repository\HostRepository;
use App\Forms\Validator;
use App\Repository\CustomerRepository;
use slugifier as s;

//sécurité
function verifyInput($var){
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

//host ou customer
if (isset($_GET['type'])){
    if (isset($_GET['id']) &&  $_GET['type'] == 'H'){
        $contacts = ContactRepository::getContactByHost($_GET['id']);
        $host = HostRepository::getHostById($_GET["id"]);
    }
    else if (isset($_GET['id']) &&  $_GET['type'] == 'C'){
        $contacts = ContactRepository::getContactByCustomer($_GET['id']);
        $customer = CustomerRepository::getCustomerById($_GET["id"]);
    }
}

//update
if (isset($_POST['submit'])){
    $code = 'HOST_' . s\slugify(verifyInput($_POST['name']), '_');
    $newContact = new Contact(0, 0,
    verifyInput($_POST['name']),
    strtoupper($code),
    verifyInput($_POST['notes']));
    $errors = Validator::checkContact($newContact);
    if (null === $errors){
        ContactRepository::updateContact($contact, $newContact);
        header("Location: View.php");
    }
}

//delete
if (isset($_POST['submit_delete'])){
    $contact = ContactRepository::getContactById($_GET['id']);
    ContactRepository::deleteContact($contact);
    header('Location: View.php');
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
                            <h2 class="nouv"><?php echo isset($host) ? $host->getName() : $customer->getName()?></h2>
                            <ul class="listContact">
                                <a href='Host/<?php echo $_GET['id']?>' class="infoGenerale">INFORMATIONS GÉNÉRALES</a>&emsp;
                                <a href="Contact//<?php echo $_GET['id']?>'>" class="contactLien">CONTACTS CLIENT</a>
                            </ul>
                        </div>

                        <!-- debut carré -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="addContact">

                                <?php

                                /* aucun contacts */
                                if (empty($contacts)){
                                    echo 'Aucun contact';
                                }
                                else{
                                    
                                    echo'<div class="col-lg-12 col-md-12 col-sm-12">';
                                    /* affichage des contacts */
                                    foreach($contacts as $contact){
                                        echo '
                                        <form method="Post">  

                                            <div class="contactAffichage">'                                                

                                                ?>

                                                <h3 class="nomContact"><?php echo $contact->getName();?></h3>
                                                
                                                <?php echo'                                                

                                                <a href="#" data-toggle="modal" data-target="#modal"class="btnRouge"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>
                                                             
                                                <br><br>
                                                
                                                <label class="lab">Nom <span style="color:red">*</span></label>
                                                <input name="name" class="AddClient" value="'.$contact->getName().'">
                                                <p class="error">';
                                                echo (!isset($errors['nameError']))? '' : $errors['nameError'];
                                                echo'</p>

                                                <br>

                                                <label class="lab">Email</label>
                                                <input size="30" class="UpClient" value="'.$contact->getEmail().'">

                                                <br>                                                

                                                <br> <br>
                                                <label class="lab2">Role</label>
                                                <textarea name="notes" class="AddClient2">'.$contact->getRole().'</textarea>
                                                <p class="error">';
                                                echo (!isset($errors['notesError']))? '' : $errors['notesError'];
                                                echo '</p>


                                                <label class="lab">Telephone</label>
                                                <input size="30" class="UpClient" value="'.$contact->getPhone().'">                                          
                                                 

                                                <!-- bouton form -->
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <!-- modal suppression -->
                                                    <div class="modal fade" id="modal"> 
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">x</button>
                                                                    <h5 class="modal-title" style="font-weight: bold;">Suppression d\'un hébergeur</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Voulez-vous vraiment supprimer l\'hébergeur <strong>"'. $contact->getName() .' "</strong> ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form method="post">
                                                                        <input type="hidden" value="'.$_GET['id'].'">
                                                                        <button type="submit" name="submit_delete" class="btnInsertSave">Supprimer</button>&emsp;
                                                                    </form>
                                                                    <button type="button" class="modalFermer1" data-dismiss="modal">Fermer</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                            
                                    }
                                }

                                ?> 
                                
                                

                                    <button type="submit" name="submit" class=""><span class="glyphicon glyphicon-ok"></span> Sauvegarder</button>&emsp;
                                    <a href="Contact/View.php" class="">Annuler</a>

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