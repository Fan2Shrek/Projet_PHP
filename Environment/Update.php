<?php 

require '../vendor/autoload.php';

use App\Classes\Environment;
use App\Classes\Project;
use App\Repository\EnvironmentRepository;
use App\Repository\ProjectRepository;
use App\Forms\Validator;
use slugifier as s;

//variable
$project = ProjectRepository::getProjectById($_GET["id"]);
$environments = EnvironmentRepository::getEnvironmentByProject($_GET["id"]);

//update
if (isset($_POST['submit'])){
    $oldEnv = EnvironmentRepository::getEnvironmentById($_POST["idEnvironnement"]);
    $newEnv = new Environment(
        0,
        Validator::verifyInput($_POST['name']),
        Validator::verifyInput($_POST['link']),
        Validator::verifyInput($_POST['ip_address']),
        Validator::verifyInput($_POST['ssh_port']),
        Validator::verifyInput($_POST['ssh_username']),
        Validator::verifyInput($_POST['phpmyadmin_link']),
        Validator::verifyInput($_POST['ip_restriction']),
        $project,
    );
    $errors = Validator::checkEnvironment($newEnv);
    if (null === $errors){
        EnvironmentRepository::updateEnvironment($oldEnv, $newEnv);
        header("Location: ".$project."-".$_GET['id'].'-1');
    }
}

//delete
if (isset($_POST['submit_delete'])){
    $environment = EnvironmentRepository::getEnvironmentById($_POST['id_env']);
    EnvironmentRepository::deleteEnvironment($environment);
    header("Location: ".$project."-".$_GET['id'].'-1');
}

//pagination
$nbPerPage = isset($_GET['nbPage']) ? $_GET['nbPage']: 2;
$currentPage = isset($_GET['page']) ? $_GET['page']: 1;

$pages = ceil(count($environments)/$nbPerPage);
$allEnv = array();

for ($i=($currentPage-1)*$nbPerPage; $i<$currentPage*$nbPerPage; $i++){
    if (isset($environments[$i])) $allEnv[] = $environments[$i];
}

$environments = $allEnv;

if(isset($_GET['page'])){
    $uri = substr($_SERVER['REQUEST_URI'], 0, -2);
}
else{
    $uri = $_SERVER['REQUEST_URI'];
}

if (empty($_GET)){
    header('Location: all?name=&link=&ip_address=&ssh_port=&ssh_username=&phpmyadmin=&ip_restriction=&nbPage=2');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <base href='../'>
        <title>Modifier un environment</title>
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
                            <h2 class="nouv"><?php echo $project->getName()?></h2>
                            <ul class="listContact">
                                <a href="Project/<?php echo $_GET['id'] ?>" class="infoGenerale2">INFORMATIONS GÉNÉRALES</a>&emsp;
                                <a class="contactLien4">ENVIRONNEMENTS PROJET</a>
                            </ul>
                        </div>

                        <!-- debut carré -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="addContact">

                                <?php

                                /* aucun environnement */
                                if (empty($environments)){
                                    echo '<p style="text-align:center; padding-top:50px;">Aucun environnement</p>';
                                }
                                else{
                                    
                                    echo'<div class="col-lg-12 col-md-12 col-sm-12">';

                                    /* affichage des environnements */

                                    foreach($environments as $environment){
                                        echo '
                                        <form method="Post">  

                                            <div class="contactAffichage">'                                                

                                                ?>
                                                                                                
                                                <h3 class="nomContact"><?php echo $environment->getName();?></h3>
                                                
                                                <?php echo'  
                                                
                                                <input type="hidden" name="idEnvironnement" value='.$environment->getId().'>

                                                <!-- nom -->
                                                <div class="group-form">
                                                    <div class="nom">                                       
                                                        <label class="labContact">Nom du contact <span style="color:red">*</span></label>
                                                        <input name="name" class="inputContact0" value="'.$environment->getName().'">
                                                    </div>
                                                </div>

                                                <!-- email -->
                                                <div class="group-form">
                                                    <div class="email">
                                                        <label class="labContact" for="email">Email&emsp;&emsp;&emsp;&emsp;&emsp;</label>
                                                        <input class="inputContact1" name="email" value="'.$environment->getLink().'">
                                                    </div>    
                                                </div>

                                                <!-- sauvegarder -->
                                                <div class="group-form">
                                                    <button type="submit" name="submit" class="btnOrange"><span class="glyphicon glyphicon-ok"></span> SAUVEGARDER</button>&emsp;                                            
                                                </div>

                                                <div class="form-right">
                                                    <div class="group-form">

                                                    <!-- supprimer -->
                                                    <a href="#" data-toggle="modal" data-target="#modal'.$environment->getId().'"class="btnRouge"><span class="glyphicon glyphicon-trash"></span> SUPPRIMER</a>

                                                        <!-- role -->
                                                        <div class="role">
                                                            <label class="labContact" for="role">Rôle</label>
                                                            <input name="role" class="inputRole" value="'.$environment->getIp_address().'">
                                                            <br><br>
                                                        </div>
                                                    </div>

                                                    <!-- telephone -->
                                                    <div class="group-form">
                                                        <div class="telephone">
                                                            <label class="labContact" for="phone">Téléphone</label>
                                                            <input class="inputTel" name="phone_number" value="'.$environment->getSsh_port().'">   
                                                        </div>    
                                                    </div>
                                                </div>

                                                <!-- bouton form -->
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <!-- modal suppression -->
                                                    <div class="modal fade" id="modal'.$environment->getId().'"> 
                                                        <div class="modal-dialog">
                                                            <div class="modal-content"> 
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">x</button>
                                                                    <h5 class="modal-title" style="font-weight: bold;">Suppression d\'un hébergeur</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Voulez-vous vraiment supprimer l\'hébergeur <strong>"'. $environment->getName() .' "</strong> ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form method="post">
                                                                        <input type="hidden" name="id_env" value="'.$environment->getId().'">
                                                                        <button type="submit" name="submit_delete" class="btnOrange">Supprimer</button>&emsp;
                                                                    </form>
                                                                    <button type="button" class="btnBlanc" data-dismiss="modal">Fermer</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>'; 
                                    }
                                }

                                ?> 
                                
                                <!-- ajouter -->
                                <br><br>
                                <a href="<?php echo $uri."-new" ?>" class="btnOrange">+ AJOUTER UN Environment</a>
                                <br><br>

                                <!-- pagination boutons -->
                                <br><br><br>
                                <div class="btnPlace1">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a <?php echo ($currentPage == 1) ? "" : "href='".$uri."-".$currentPage - 1 ."'"?> class="page-link"><span class="glyphicon glyphicon-chevron-left"></span></a>
                                        </li>
                                        <?php for($page = 1; $page <= $pages; $page++): ?>
                                        <li class="page-item <?php echo ($currentPage == $page) ? "active" : "" ?>">
                                            <a href="<?php echo $uri.'-'.$page?>" class="page-link"><?= $page ?></a>
                                        </li>
                                        <?php endfor ?>
                                        <li class="page-item" >
                                            <a <?php echo ($currentPage == $pages) ? "" : "href='".$uri."-".$currentPage + 1 ."'"?> class="page-link"><span class="glyphicon glyphicon-chevron-right"></span></a>
                                        </li>
                                    </ul>                                     
                                </div>
                                <br><br>

                                </form>                                

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </section>
        
        <!-- footer -->
        <?php require '../layout/footer.php' ?>
        
    </body>
</html>