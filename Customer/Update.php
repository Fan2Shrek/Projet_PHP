<!DOCTYPE html>
<html>
    <head>
        <title>Modifier un client</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="../js/script.js"></script>
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    
    <body>
        
        <?php require '../layout/navbar.php' ?>
        
        <section id="insertClient">

            <div class="container-fluid">
                <div class="row">

                    
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <?php require '../layout/menu.php' ?>
                    </div>

                    <!-- titre -->
                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <h3 class="nouv">NOM DU CLIENT</h3> <!-- ATTENTION A NE PAS OUBLIER D'AJOUTER LE NOM DU CLIENT -->

                        <!-- section1 -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="infoGenerale">
                                <p><strong>INFORMATIONS GÉNÉRALES</strong></p>
                            </div>
                        </div>

                        <!-- debut carré -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="addClient">

                                <!-- début form -->
                                <form method='Post'>

                                    <label class="lab">Nom <span style="color:red">*</span></label>
                                    <input name='name' class="AddClient" value=""><!-- MONTRER VALEUR NOM -->

                                    <br>

                                    <label class="lab">Code interne</label>
                                    <button disabled="disabled" class="AddClient1" value="">Champs généré automatiquement</button><!-- MONTRER VALEUR CODE MAIS NON MODIFIABLE -->

                                    <br>

                                    <label class="lab2">Notes / remarques</label>
                                    <textarea name='notes' class="AddClient2"></textarea><!-- MONTRER VALEUR NOTES MODIFIABLES-->

                                    <!-- bouton form -->
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="btnAdd">
                                            <a href="Insert.php" class="btnInsert1">Annuler</a>&emsp;
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