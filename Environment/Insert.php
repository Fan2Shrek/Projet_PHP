<?php 

require '../vendor/autoload.php';

use App\Classes\Environment;
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
                                                        <label class="lab">Nom<span style="color: red"> *</span>&emsp;&emsp;&emsp;&emsp;</label>
                                                        <input name="name" class="inputEnv0" value="">
                                                    </div>                                                    
                                                </div>

                                                <div class="group-form">
                                                    <div class="email">
                                                        <label class="lab" for="email">Adresse IP&emsp; </label>
                                                        <input class="inputEnv1" name="email" value="">
                                                    </div>    
                                                </div>
                                                
                                                <div class="group-form">
                                                    <div class="email">
                                                        <label class="lab" for="email">Nom d'utilisateur&emsp;</label>
                                                        <input class="inputEnv2" name="email" value="">
                                                    </div>    
                                                </div> 

                                                <div class="group-form">
                                                    <div class="email">
                                                        <label class="lab">Projet<span style="color: red"> *</span>&emsp;&emsp;&emsp;</label>
                                                        <select class="selectEnv">
                                                            <option></option>
                                                        </select>
                                                        
                                                    </div>
                                                </div>

                                                
                                                <div class="form-right2">
                                                    
                                                    <div class="group-form">
                                                        <div class="role">
                                                            <label class="labContact" for="role">Port SSH</label>
                                                            <input name="role" class="inputEnv3" value="">
                                                            <br><br>
                                                        </div>
                                                        <input type="checkbox">Restriction IP
                                                    </div>

                                                    <div class="group-form">
                                                        <div class="telephone">
                                                            <label class="labContact" for="phone">Lien PHPMyAdmin</label>
                                                            <input class="inputTel" name="phone_number" value="">   
                                                        </div>    
                                                    </div>

                                                    <div class="group-form">
                                                        <div class="telephone">
                                                            <label class="labContact" for="phone">Lien</label>
                                                            <input class="inputTel" name="phone_number" value="">   
                                                        </div>    
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                            
                                                                  
                                
                                    <br><br>
                                    <a href="" class="btnOrange">+ AJOUTER</a>

                                    
                                    

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