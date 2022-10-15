<?php 

require 'src/autoloader.php';

use App\Classes\Customer;
use App\Repository\CustomerRepository;
use App\Forms\Validator;

if (isset($_GET['id'])){
    $customer = CustomerRepository::getCustomerById($_GET['id']);
}

if (isset($_POST['submit'])){
    $newCustomer = new Customer(0,
    '',
    $_POST['name'],
    $_POST['notes']);
    $errors = Validator::checkCustomer($newCustomer);
    if (null === $errors){
        CustomerRepository::updateCustomer($customer, $newCustomer);
        header("Location: index.php");
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
        <title>Modifier un client</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="../js/script.js"></script>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    
    <body>
        
        <?php require 'layout/navbar.php' ?>
        
        <section id="insertClient">

            <div class="container-fluid">
                <div class="row">

                    
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <?php require 'layout/menu.php' ?>
                    </div>

                    <!-- titre -->
                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <h3 class="nouv">NOM DU CLIENT</h3> <!-- ATTENTION A NE PAS OUBLIER D'AJOUTER LE NOM DU CLIENT -->

                        <!-- section1 -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
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
                                    <input name='name' class="AddClient" value="<?php echo $customer->getName(); ?>"><!-- MONTRER VALEUR NOM -->
                                    <small style="color:red; font-style:italic;"><?php echo (!isset($errors['nameError']))? '' : $errors['nameError'] ?></small>

                                    <br>

                                    <label class="lab">Code interne</label>
                                    <button disabled="disabled" class="AddClient1" value=""><?php echo $customer->getCode(); ?></button><!-- MONTRER VALEUR CODE MAIS NON MODIFIABLE -->

                                    <br>

                                    <label class="lab2">Notes / remarques</label>
                                    <textarea name='notes' class="AddClient2"><?php echo $customer->getNotes(); ?></textarea><!-- MONTRER VALEUR NOTES MODIFIABLES-->
                                    <small style="color:red; font-style:italic;"><?php echo (!isset($errors['notesError']))? '' : $errors['notesError'] ?></small>

                                    <!-- bouton form -->
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="btnAdd">
                                            <a href="index.php" class="btnInsert1">Annuler</a>&emsp;
                                            <button type='submit' name='submit' class="btnInsertSave"><span class="glyphicon glyphicon-ok"></span> Sauvegarder</button>
                                        </div>

                                        <form method="post">
                                            <input type='hidden' value="<?php echo $_GET['id']?>">
                                            <button type='submit' name='submit_delete' ></span> Supprimer</button>
                                        </form>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </section>
        
        <?php require 'layout/footer.php' ?>
        
    </body>

</html>