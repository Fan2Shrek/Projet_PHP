<?php 

require '../vendor/autoload.php';

use App\Classes\Customer;
use App\Repository\CustomerRepository;
use App\Forms\Validator;
use slugifier as s;

function verifyInput($var){
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

if (isset($_GET['id'])){
    $customer = CustomerRepository::getCustomerById($_GET['id']);
}

if (isset($_POST['submit'])){
    $code = 'CUST_'. s\slugify(verifyInput($_POST['name']), '_');
    $newCustomer = new Customer(0,
    $code,
    verifyInput($_POST['name']),
    verifyInput($_POST['notes']));
    $errors = Validator::checkCustomer($newCustomer);
    if (null === $errors){
        CustomerRepository::updateCustomer($customer, $newCustomer);
        header("Location: View.php");
    }
}

if (isset($_POST['submit_delete'])){
    $customer = CustomerRepository::getCustomerById($_GET['id']);
    CustomerRepository::deleteCustomer($customer);
    header('Location: View.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <base href='../'>
        <title>Modifier un client</title>
        <base href="../">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="public/js/script.js"></script>
        <link rel="stylesheet" href="public/css/styles.css">
    </head>
    
    <body>
        
        <?php require '../layout/navbar.php' ?>
        
        <section id="update">

            <div class="container-fluid">
                <div class="row">

                    
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <?php require '../layout/menu.php' ?>
                    </div>

                    <!-- titre -->
                    <div class="col-lg-9 col-md-9 col-sm-12">

                        <!-- section -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h3 class="nouv"><?php echo $customer->getName();?></h3>
                            <div class="infoGenerale">
                                <p><strong>INFORMATIONS GÉNÉRALES</strong></p>
                            </div>
                        </div>

                        <!-- debut carré -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="addClient">

                                <!-- début form -->
                                <form method='Post'>

                                    <label class="lab">Nom <span style="color:red">*</span></label>
                                    <input name='name' class="AddClient" value="<?php echo $customer->getName(); ?>">
                                    <p class="error"><?php echo (!isset($errors['nameError']))? '' : $errors['nameError'] ?></p>

                                    <br>

                                    <label class="lab">Code interne</label>
                                    <input size="30" disabled="disabled" class="UpClient" value="<?php echo $customer->getCode(); ?>">

                                    <br>

                                    <label class="lab2">Notes / remarques</label>
                                    <textarea name='notes' class="AddClient2"><?php echo $customer->getNotes(); ?></textarea>
                                    <p class="error"><?php echo (!isset($errors['notesError']))? '' : $errors['notesError'] ?></p>

                                    <!-- bouton form -->
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="btnAdd6">   
                                            <button type='submit' name='submit' class="btnInsertSave"><span class="glyphicon glyphicon-ok"></span> Sauvegarder</button>&emsp;
                                            <a href="#" data-toggle='modal' data-target='#modal'class="btnInsertSave"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>
                                        </div>
                                        <br>
                                        <div class="btnAdd2">
                                            <a href="Customer/View.php" class="btnInsert1">Annuler</a> 
                                        </div>

                                        <!-- modal suppression -->
                                        <div class='modal fade' id='modal'> 
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal'>x</button>
                                                        <h5 class='modal-title' style="font-weight: bold;">Suppression d'un client</h5>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <p>Voulez-vous vraiment supprimer le client <strong>"<?php echo $customer->getName(); ?>"</strong> ?</p>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <form method="post">
                                                            <input type='hidden' value="<?php echo $_GET['id']?>">
                                                            <button type='submit' name='submit_delete' class="btnInsertSave">Supprimer</button>&emsp;
                                                        </form>
                                                        <button type='button' class='modalFermer1' data-dismiss='modal'>Fermer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                          
                                    </div>

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