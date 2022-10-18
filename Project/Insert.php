<?php

require '../src/autoloader.php';

use App\Classes\Customer;
use App\Classes\Project;
use App\Repository\ProjectRepository;
use App\Forms\Validator;

$errors = array();

function verifyInput($var){
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

if (isset($_POST['submit'])){
    $code = 'CUST_'. verifyInput($_POST['name']);
    $project = new Project(0,//en cours PAS FONCTIONNEL PAS FINI
    $code,
    verifyInput($_POST['name']),
    verifyInput($_POST['notes']));

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
        
        <section id="insertClient">

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
                                    <label class="lab">Nom <span style="color:red">*</span></label>
                                    <input name='name' class="AddClient" value="<?php echo (!isset($_POST['name']))? '' : $_POST['name'] ?>">
                                    <p class="error"><?php echo (!isset($errors['nameError']))? '' : $errors['nameError'] ?></p>

                                    <br>

                                    <label class="lab">Code interne</label>
                                    <button disabled="disabled" class="AddClient1">Champs généré automatiquement</button>


                                    

                                    <br>






                                    <select type="text" class="select" name="" id="" value="
                                    
                                    <?php 

                                    foreach ($customer as $customer) 
                                    {
                                        echo '<option value="'. $customer->getCustomer()->getName() . '">'. '</option>';
                                    }

                                    ?>">

                                    </select>






                                    <select type="text" class="select" name="" id="" value="<?php echo $host->getName();?>">
                                    
                                    <?php 

                                    foreach ($host as $host) 
                                    {
                                        echo "<option value='. $host->getName() . '></option>'";
                                    }

                                    

                                    

                                    ?>

                                    </select>





                                    <label class="lab2">Notes / remarques</label>
                                    <textarea name='notes' class="AddClient2"><?php echo (!isset($_POST['notes']))? '' : $_POST['notes'] ?></textarea>
                                    <p class="error"><?php echo (!isset($errors['notesError']))? '' : $errors['notesError'] ?></p>



                                    <!-- col-lg-6 -->


                                    <label class="lab">Dossier Lastpass</label>
                                    <input name='dossier_lastpass' class="AddClient" value="<?php echo (!isset($_POST['dossier_lastpass']))? '' : $_POST['dossier_lastpass'] ?>">
                                    <p class="error"><?php echo (!isset($errors['nameError']))? '' : $errors['nameError'] ?></p>



                                    <label class="lab">Lien maquettes</label>
                                    <input name='lien_maquettes' class="AddClient" value="<?php echo (!isset($_POST['lien_maquettes']))? '' : $_POST['lien_maquettes'] ?>">
                                    <p class="error"><?php echo (!isset($errors['nameError']))? '' : $errors['nameError'] ?></p>



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