<?php 

require '../src/autoloader.php';

use App\Repository\HostRepository;

$host = HostRepository::getHost();
?>

<!DOCTYPE html>
<html>
    <head>
        <base href='../'>
        <title>Lister des hébergeurs</title>
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
                        <h3 class="nouv">&emsp;Hébergeurs</h3>

                         <!-- debut carré -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            
                            <div class="fondTableau">

                            <div class="table-responsive">

                                <table class="table table-bordered" id="tabClient">
                                    <tr class="trTableau">
                                        <th>Nom</th>
                                        <th>Code</th>
                                        <th>Notes</th>
                                        <th>Modifier</th>
                                    </tr>
                                    <?php
                                        foreach ($host as $host){
                                            echo "<tr class='tr2Tableau'>
                                                <td>". $host->getName() ."</td>
                                                <td>". $host->getCode() ."</td>
                                                <td>". $host->getNotes() ."</td>
                                                <td>
                                                    <a class='aTabl' href='Host/". $host->getId() ."'>Modifier</a>
                                                </td>
                                            </tr>";
                                        }   
                                    ?>
                                </table>

                            </div>

                                <div class="btnAdd2">
                                    <a href='Host/Insert.php' class="btnInsertLien">+ Ajouter</a>&emsp;
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