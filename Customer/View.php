<!DOCTYPE html>
<html>
    <head>
    <title>Consuler les clients</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="../js/script.js"></script>
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    
    <body>
        
        <?php require '../layout/navbar.php' ?>
        
        <section id="viewClient">

            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <?php require '../layout/menu.php' ?>
                    </div>

                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <h3 class="nouv">Clients</h3>

                        <div class="fondTableau">

                            <table class="table table-bordered">
                                <tr>
                                    <th>Nom</th>
                                    <th>Code</th>
                                    <th>Notes</th>
                                    <th>Modifier</th>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                            </table>


                        </div>
                        


                        

                    </div>

                </div>
            </div>

        </section>
        

<a href="insert.php">insert</a>
<a href="Update.php">update</a>

        <?php require '../layout/footer.php' ?>
        
    </body>

</html>