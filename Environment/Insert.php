<?php 

require '../vendor/autoload.php';

use App\Classes\Environment;
use App\Classes\Project;
use App\Repository\EnvironmentRepository;
use App\Repository\ProjectRepository;
use App\Forms\Validator;
use slugifier as s;

//sécurité
function verifyInput($var){
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

//insert
if (isset($_POST['submit'])){

    $name = (isset($_POST['name'])) ? $_POST['name'] : null ;
    $link = (isset($_POST['link'])) ? $_POST['link'] : null ;
    $ip_address = (isset($_POST['ip_address'])) ? $_POST['ip_address'] : null ;
    $ssh_port = (isset($_POST['ssh_port'])) ? $_POST['ssh_port'] : null ;
    $ssh_username = (isset($_POST['ssh_username'])) ? $_POST['ssh_username'] : null ;
    $phpmyadmin_link = (isset($_POST['phpmyadmin_link'])) ? $_POST['phpmyadmin_link'] : null ;
    $ip_restriction = (isset($_POST['ip_restriction'])) ? 1 : 0;

    $project = (isset($_POST['project'])) ? ProjectRepository::getProjectById($_POST['project']) : new Project(0,0,0,0,0,0,0,0,0);

    $environment = new Environment(
        0,
        verifyInput($_POST['name']),
        verifyInput($_POST['link']),
        verifyInput($_POST['ip_address']),
        verifyInput($_POST['ssh_port']),
        verifyInput($_POST['ssh_username']),
        verifyInput($_POST['phpmyadmin_link']),
        verifyInput($_POST['ip_restriction']),
        $project,
    );
    
    EnvironmentRepository::addEnvironment($environment);
    header("Location: Insert.php");
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <base href='../'>
        <title>Ajouter un environment</title>
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

                    <!-- menu -->                 
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <?php require '../layout/menu.php' ?>
                    </div>

                    <!-- titre -->
                    <div class="col-lg-9 col-md-9 col-sm-12">

                        <!-- lien -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h2 class='nouv'>Nouvel environnement</h2>
                            <ul class="listContact">
                                <a href="Project/insert.php" class="infoGenerale2">INFORMATIONS GÉNÉRALES</a>&emsp;
                                <a href="Environment/insert.php" class="contactLien4">CONTACTS ENVIRONNEMENT</a>
                            </ul>
                        </div>

                        <!-- debut carré -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="add">

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                        <form method="Post">  

                                            <div class="contactAffichage">
                                                                                                                                                                                            
                                                <input type="hidden" name="idContact" value=''>

                                                <div class="group-form">
                                                    <div class="nom">                                       
                                                        <label class="lab" for="name">Nom<span style="color: red"> *</span>&emsp;&emsp;&emsp;&emsp;</label>
                                                        <input name="name" class="inputEnv0" value="<?php echo $_POST['name'] ?? '' ?>">
                                                    </div>                                                    
                                                </div>

                                                <div class="group-form">
                                                    <div class="email">
                                                        <label class="lab" for="ip_address">Adresse IP&emsp; </label>
                                                        <input class="inputEnv1" name="ip_address" value="<?php echo $_POST['ip_address'] ?? '' ?>">
                                                    </div>    
                                                </div>
                                                
                                                <div class="group-form">
                                                    <div class="email">
                                                        <label class="lab" for="ssh_username">Nom d'utilisateur&emsp;</label>
                                                        <input class="inputEnv2" name="ssh_username" value="<?php echo $_POST['ssh_username'] ?? '' ?>">
                                                    </div>    
                                                </div> 

                                                <div class="group-form">

                                                    <div class="email">
                                                        <label class="lab" for='project'>Projet <span style="color:red">*&emsp;</span></label>
                                                        <select type="text" name='project' class="select0">
                                                            <option disabled selected>Sélectionner un projet</option>
                                                            <?php 

                                                            $project = ProjectRepository::getProject();

                                                            foreach ($project as $project) 
                                                            {
                                                                echo '<option value="'. $project->getId() . '">'. $project->getName() . '</option>';
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>

                                                </div>

                                                
                                                <div class="form-right2">
                                                    
                                                    <div class="group-form">
                                                        <div class="role">
                                                            <label class="labContact" for="ssh_port">Port SSH</label>
                                                            <input name="ssh_port" class="inputEnv3" value="<?php echo $_POST['ssh_port'] ?? '' ?>">
                                                            <br><br>
                                                        </div>
                                                        <label for="ip_restriction">
                                                        <input type="checkbox" name="ip_restriction">Restriction IP</label>
                                                    </div>

                                                    <div class="group-form">
                                                        <div class="telephone">
                                                            <label class="labContact" for="phpmyadmin_link">Lien PHPMyAdmin</label>
                                                            <input class="inputTel" name="phpmyadmin_link" value="<?php echo $_POST['phpmyadmin_link'] ?? '' ?>">
                                                        </div>    
                                                    </div>

                                                    <div class="group-form">
                                                        <div class="telephone">
                                                            <label class="labContact" for="link">Lien</label>
                                                            <input class="inputTel" name="link" value="<?php echo $_POST['link'] ?? '' ?>">   
                                                        </div>    
                                                    </div>
                                                </div>

                                            </div>

                                            <br><br>
                                            <button type="submit" name="submit" class="btnOrange">+ AJOUTER</a>

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