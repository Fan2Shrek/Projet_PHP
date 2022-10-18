<?php 

require '../src/autoloader.php';

use App\Repository\ProjectRepository;

$project = ProjectRepository::getProject();
?>

<!DOCTYPE html>
<html>
    <head>
        <base href='../'>
        <title>Liste des projets</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="js/script.js"></script>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    
    <body>
        
        <?php require '../layout/navbar.php' ?>
        
        <section id="viewClient">

            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <?php require '../layout/menu.php' ?>
                    </div>

                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <h3 class="nouv">&emsp;Projets</h3>

                         <!-- debut carré -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            
                            <div class="fondTableau">

                            <div class="table-responsive">

                                <table class="table table-bordered" id="tabClient">
                                    <tr class="trTableau">
                                        <th>NOM</th>
                                        <th>CLIENT</th>
                                        <th>HÉBERGEURS</th>
                                        <th>Modifier</th>
                                    </tr>
                                    <?php
                                        foreach ($project as $project){
                                            echo "<tr class='tr2Tableau'>
                                                <td>". $project->getName() ."</td>
                                                <td>". $project->getCustomer()->getName() ."</td>
                                                <td>". $project->getHost()->getName() ."</td>
                                                <td>
                                                    <a class='aTabl' href='Project/". $project->getId() ."'>Modifier</a>
                                                </td>
                                            </tr>";
                                        }   
                                    ?>
                                </table>

                            </div>

                                <div class="btnAdd2">
                                    <a href='Project/Insert.php' class="btnInsertLien">+ Ajouter</a>&emsp;
                                </div>
                                <br>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </section>

        <?php require '../layout/footer.php' ?>
        
    </body>
</html>