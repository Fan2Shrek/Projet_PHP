<?php

require '../vendor/autoload.php';

use App\Classes\Customer;
use App\Classes\Host;
use App\Classes\Project;
use App\Repository\ProjectRepository;
use App\Repository\CustomerRepository;
use App\Repository\HostRepository;
use App\Forms\Validator;
use slugifier as s;

$errors = array();

function verifyInput($var){
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

if (isset($_POST['submit'])){
    $code = s\slugify('CUST_'. verifyInput($_POST['name']), '_');
    $code = strtoupper($code);
    $lastpass_folder = (isset($_POST['lastpass_folder'])) ? $_POST['lastpass_folder'] : null ;
    $link_mock_ups = (isset($_POST['link_mock_ups'])) ? $_POST['link_mock_ups'] : null ;
    $managed_server = (isset($_POST['managed_server'])) ? 1 : 0;
    $host = (isset($_POST['host'])) ? HostRepository::getHostById($_POST['host']) : new Host(0,0,0,0);
    $customer = (isset($_POST['customer'])) ? CustomerRepository::getCustomerById($_POST['customer']) : new Customer(0,0,0,0);

    $project = new Project(0,
    verifyInput($_POST['name']),
    $code,
    verifyInput($lastpass_folder),
    verifyInput($link_mock_ups),
    verifyInput($managed_server),
    verifyInput($_POST['notes']),
    $host,
    $customer);

    $errors = Validator::checkProjet($project);
    if (null === $errors){
        ProjectRepository::addProject($project);
        header("Location: View.php");
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <base href='../'>
        <title>Ajouter un projet</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="public/js/script.js"></script>
        <link rel="stylesheet" href="public/css/styles.css">
    </head>
    
    <body>
        
        <?php require '../layout/navbar.php' ?>
        
        <section id="insertProjet">

            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <?php require '../layout/menu.php' ?>
                    </div>

                    <!-- titre -->
                    <div class="col-lg-9 col-md-9 col-sm-12">

                        <!-- section -->
                        <div class="col-lg-12 col-md-12 col-sm-12">

                        <h3 class="nouv">Nouveau projet</h3>

                            <div class="infoGenerale">
                                <p><strong>INFORMATIONS GÉNÉRALES</strong></p>
                            </div>
                        </div>

                        <!-- debut carré -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="addClient">

                                <!-- début form -->
                                <form method='Post'>

                                    <!-- col-lg-6-->
                                    <label class="lab" for='name'>Nom <span style="color:red">*</span></label>
                                    <input name='name' class="AddClient" value="<?php echo (!isset($_POST['name']))? '' : $_POST['name'] ?>">
                                    <p class="error"><?php echo (!isset($errors['nameError']))? '' : $errors['nameError'] ?></p>

                                    <br>

                                    <label class="lab">Code interne</label>
                                    <button disabled="disabled" class="AddClient1">Champs généré automatiquement</button>

                                    <br>

                                    <label class="lab" for='customer'>Client <span style="color:red">*</span></label>
                                    <select type="text" name='customer' class="AddClient">  
                                        <option disabled selected>Selectionnez un client</option>
                                    <?php 

                                    $customers = CustomerRepository::getCustomer();

                                    foreach ($customers as $customer) 
                                    {
                                        echo '<option value="'. $customer->getId() . '">'. $customer->getName() . '</option>';
                                    }

                                    ?>
                                    </select>
                                    <p class="error"><?php echo (!isset($errors['customerError']))? '' : $errors['customerError'] ?></p>

                                    <br>

                                    <label class="lab" for='host'>Herbergeur <span style="color:red">*</span></label>
                                    <select type="text" name='host' class="AddClient">
                                        <option disabled selected>Selectionnez un hebergeur</option>
                                    
                                    <?php 

                                    $host = HostRepository::getHost();

                                    foreach ($host as $host) 
                                    {
                                        echo '<option value="'. $host->getId() . '">'. $host->getName() . '</option>';
                                    }

                                    ?>

                                    </select>
                                    <p class="error"><?php echo (!isset($errors['hostError']))? '' : $errors['hostError'] ?></p>
                                    
                                    <label class="lab" for='managed_server'>Serveur infogéré</label>
                                    <input name='managed_server' type='checkbox' class="AddClient" class="AddClient">

                                    <label class="lab2">Notes / remarques</label>
                                    <textarea name='notes' class="AddClient2"><?php echo (!isset($_POST['notes']))? '' : $_POST['notes'] ?></textarea>
                                    <p class="error"><?php echo (!isset($errors['notesError']))? '' : $errors['notesError'] ?></p>



                                    <!-- col-lg-6 -->

                                    <div class='project-right'>
                                        <label class="lab">Dossier Lastpass</label>
                                        <input name='lastpass_folder' class="AddClient" value="<?php echo (!isset($_POST['lastpass_folder']))? '' : $_POST['lastpass_folder'] ?>">

                                        <label class="lab">Lien maquettes</label>
                                        <input name='link_mock_ups' class="AddClient" value="<?php echo (!isset($_POST['link_mock_ups']))? '' : $_POST['link_mock_ups'] ?>">
                                    </div>                                    
                                    
                                    <!-- bouton form -->
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="btnAdd">
                                            <a href="Customer/View.php" class="btnInsert1">Annuler</a>&emsp;
                                            <button type='submit' name='submit' class="btnInsertSave"><span class="glyphicon glyphicon-ok"></span> Sauvegarder</button>
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