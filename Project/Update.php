<?php 

require '../src/autoloader.php';

use App\Classes\Customer;
use App\Classes\Host;
use App\Classes\Project;
use App\Repository\ProjectRepository;
use App\Repository\CustomerRepository;
use App\Repository\HostRepository;
use App\Forms\Validator;
use slugifier as s;

/* sécurité */
function verifyInput($var){
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

/* id */
if (isset($_GET['id'])){
    $project = ProjectRepository::getProjectById($_GET['id']);
}

/* update */
if (isset($_POST['submit'])){
    $newProject = new Project(0,
    verifyInput($_POST['name']),
    $code = s\slugify('PROJECT_'. verifyInput($_POST['name']), '_'),
    verifyInput($_POST['lastpass_folder']),
    verifyInput($_POST['link_mock_ups']),
    verifyInput($_POST['managed_server']),
    verifyInput($_POST['notes']),
    $host,
    $customer);

    $errors = Validator::checkProjet($newProject);
    if (null === $errors){
        ProjectRepository::updateProject($project, $newProject);
        header("Location: View.php");
    }
}

/* delete */
if (isset($_POST['submit_delete'])){
    $project = ProjectRepository::getProjectById($_GET['id']);
    ProjectRepository::deleteProject($project);
    header('Location: View.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <base href='../'>
        <title>Modifier un projet</title>
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
                    
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <?php require '../layout/menu.php' ?>
                    </div>

                    <!-- titre -->
                    <div class="col-lg-9 col-md-9 col-sm-12">

                        <!-- section -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h3 class="nouv"><?php echo $project->getName();?></h3>
                            <div class="infoGenerale">
                                <p><strong>INFORMATIONS GÉNÉRALES</strong></p>
                            </div>
                        </div>

                        <!-- debut carré -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="addClient">

                                <!-- début form -->
                                <form method='Post'>

                                    <div class="col-lg-6 col-md-12 col-sm-12">

                                        <!-- nom -->
                                        <label class="lab" for='name'>Nom <span style="color:red">*</span></label>
                                        <input name='name' class="AddProject" value="<?php echo $project->getName()?>">
                                        <p class="error"><?php echo (!isset($errors['nameError']))? '' : $errors['nameError'] ?></p><br>

                                        <!-- code -->
                                        <label class="lab">Code interne</label>
                                        <button disabled="disabled" class="AddClient1">Champs généré automatiquement</button><br><br>
                                        
                                        <!-- client -->
                                        <label class="lab" for='customer'>Client <span style="color:red">*</span></label>
                                        <select type="text" name='customer' class="select"> 
                                        
                                            <option>EN COURS</option>
                                            <?php 

                                            $customers = CustomerRepository::getCustomer();                                            

                                            foreach ($customers as $customer) 
                                            {
                                                echo '<option value="'. $customer->getId() . '">'. $customer->getName() . '</option>';
                                            }

                                            ?>
                                        </select>
                                        <p class="error"><?php echo (!isset($errors['customerError']))? '' : $errors['customerError'] ?></p><br>

                                        <!-- hebergeur -->
                                        <label class="lab" for='host'>Herbergeur <span style="color:red">*</span></label>
                                        <select type="text" name='host' class="select1">
                                            <option disabled selected>EN COURS</option>
                                            <?php 

                                            $host = HostRepository::getHost();

                                            foreach ($host as $host) 
                                            {
                                                echo '<option value="'. $host->getId() . '">'. $host->getName() . '</option>';
                                            }

                                            ?>
                                        </select>
                                        <p class="error"><?php echo (!isset($errors['hostError']))? '' : $errors['hostError'] ?></p><br>
                                        
                                        <!-- serveur infogéré -->  
                                        <label class="labCheck" for='managed_server'>
                                        <input name='managed_server' type='checkbox' value="<?php echo $project->getManaged_server(); ?>"></label> Serveur infogéré<br><br>
                                        
                                        <!-- notes -->
                                        <label class="lab2">Notes / remarques</label>
                                        <textarea name='notes' class="AddProject2"><?php echo $project->getNotes();?></textarea>
                                        <p class="error"><?php echo (!isset($errors['notesError']))? '' : $errors['notesError'] ?></p>

                                    </div>

                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                    
                                        <!-- dossier lastpass-->
                                        <label class="lab3">Dossier Lastpass</label>
                                        <input name='lastpass_folder' class="AddProject3" value="<?php echo $project->getLastpast_folder() ;?>"><br>
                                        
                                        <!-- lien maquettes-->
                                        <label class="lab4">Lien</label>
                                        <input name='link_mock_ups' class="AddProject4" value="<?php echo $project->getLink_mock_ups() ;?>">
                                    
                                    </div>
                                
                                
                                    <!-- bouton form -->
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="btnAdd3">   
                                            <button type='submit' name='submit' class="btnInsertSave"><span class="glyphicon glyphicon-ok"></span> Sauvegarder</button>&emsp;
                                            <a href="#" data-toggle='modal' data-target='#modal'class="btnInsertSave"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>
                                        </div>
                                        <br>
                                        <div class="btnAdd2">
                                            <a href="Project/View.php" class="btnInsert1">Annuler</a> 
                                        </div>

                                        <!-- modal suppression -->
                                        <div class='modal fade' id='modal'> 
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal'>x</button>
                                                        <h5 class='modal-title' style="font-weight: bold;">Suppression d'un projet</h5>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <p>Voulez-vous vraiment supprimer le projet <strong>"<?php echo $project->getName(); ?>"</strong> ?</p>
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