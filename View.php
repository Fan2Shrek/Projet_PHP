<?php 

require 'src/autoloader.php';

use App\Repository\CustomerRepository;

$customers = CustomerRepository::getCustomers();
?>

<!DOCTYPE html>
<html>
    <head>
    <title>Consuler les clients</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="js/script.js"></script>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    
    <body>
        
        <?php require 'layout/navbar.php' ?>
        
        <section id="viewClient">

            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <?php require 'layout/menu.php' ?>
                    </div>

                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <h3 class="nouv">&emsp;Clients</h3>

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
                                        foreach ($customers as $customer){
                                            echo "<tr class='tr2Tableau'>
                                                <td>". $customer->getName() ."</td>
                                                <td>". $customer->getCode() ."</td>
                                                <td>". $customer->getNotes() ."</td>
                                                <td>
                                                    <a class='aTabl' href='Update.php?id=". $customer->getId() ."'>Modifier</a>
                                                </td>
                                            </tr>";
                                        }   
                                    ?>
                                </table>

                            </div>

                                <div class="btnAdd2">
                                    <a href='insert.php' class="btnInsertLien">+ Ajouter</a>&emsp;
                                </div>
                                <br>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </section>

        <?php require 'layout/footer.php' ?>
        
    </body>
</html>