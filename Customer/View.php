<?php 

require '../vendor/autoload.php';

use App\Repository\CustomerRepository;

//filtre 
$filtre = array();
if (isset($_GET['code']) && $_GET['code'] != ''){
    $filtre[] = CustomerRepository::getByCode($_GET['code']);
}
if (isset($_GET['name']) && $_GET['name'] != ''){
    $filtre[] = CustomerRepository::getByName($_GET['name']);
}
if (isset($_GET['notes']) && $_GET['notes'] != ''){
    $filtre[] = CustomerRepository::getByNotes($_GET['notes']);
}
else{
    $customers = CustomerRepository::getCustomer();
}

//affichage filtre
if (!empty($filtre)){
    if (count($filtre) == 1){
        $customers = $filtre[0];
    }
    elseif (count($filtre) ==2){
        $customers = array_intersect($filtre[0], $filtre[1]);
    }
    elseif (count($filtre) ==3){
        $customers = array_intersect($filtre[0], $filtre[1], $filtre[2]);
    }
}

//pagination
$nbPerPage = isset($_GET['nbPage']) ? $_GET['nbPage']: 15;
$currentPage = isset($_GET['page']) ? $_GET['page']: 1;

$pages = ceil(count($customers)/$nbPerPage);
$allCustomer = array();

for ($i=($currentPage-1)*$nbPerPage; $i<$currentPage*$nbPerPage; $i++){
    if (isset($customers[$i])) $allCustomer[] = $customers[$i];
}

$customers = $allCustomer;

if(isset($_GET['page'])){
    $uri = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "&page="));
}
else{
    $uri = $_SERVER['REQUEST_URI'];
}

if (empty($_GET)){
    header('Location: all?name=&customer=&host=&nbPage=15');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <base href='../'>
        <title>Liste des clients</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="public/js/script.js"></script>
        <link rel="stylesheet" href="public/css/styles.css">
    </head>
    
    <body>
        
        <?php require '../layout/navbar.php' ?>
        
        <section id="View">

            <div class="container-fluid">
                <div class="row">

                    <!-- menu -->
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <?php require '../layout/menu.php' ?>
                    </div>

                    <!-- section -->
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <h3 class="nouv">&emsp;Clients</h3>

                         <!-- debut carr?? -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            
                            <div class="fondTableau">

                                <!-- d??but tableau -->
                                <div class="table-responsive">

                                    <!-- form -->
                                    <form>

                                        <table class="table table-bordered" id="tabClient">

                                            <!-- titre -->
                                            <tr class="trTableau">
                                                <th>CODE</th>
                                                <th>NOM</th>
                                                <th>NOTES</th>
                                                <th>MODIFIER</th>
                                            </tr>

                                            <!-- filtre -->
                                            
                                                <tr>
                                                    <td><input class="inputSearch" name='code' value='<?php echo (isset($_GET['code'])) ? $_GET['code'] : "" ?>'></td>
                                                    <td><input class="inputSearch" name='name' value='<?php echo (isset($_GET['name'])) ? $_GET['name'] : "" ?>'></td>
                                                    <td><input class="inputSearch" name='notes' value='<?php echo (isset($_GET['notes'])) ? $_GET['notes'] : "" ?>'></td>
                                                    <td>
                                                        <button type='submit' style='display:none'>Chercher</button>
                                                        <a class='reset' href='Customer/all'>X</button>
                                                    </td>
                                                </tr>
                                            
                                            <!-- affichage -->
                                            <?php
                                                if (empty($customers)){
                                                    echo '<tr><td colspan="4" style="text-align:center">Aucun client ne corespond ?? votre recherche</td></tr>';
                                                }
                                                else{
                                                    foreach ($customers as $customers){
                                                        echo "<tr class='tr2Tableau'>
                                                            <td>". $customers->getCode() ."</td>
                                                            <td>". $customers->getName() ."</td>
                                                            <td>". $customers->getNotes() ."</td>
                                                            <td>
                                                                <a class='aTabl' href='Customer/". $customers->getId() ."'>Modifier</a>
                                                            </td>
                                                        </tr>";
                                                    }  
                                                } 
                                            ?>

                                        </table>

                                        <!-- pagination choix affichage -->
                                        <div class="col-lg-3 col-md-3 sm-3"> 
                                            <div class="paginationCSS">                                          
                                                <label class="labelPagination">R??sultats/pages&emsp;</label>
                                                <select name='nbPage' onchange="this.form.submit()" class="selectPagination">
                                                    <option value="5" <?php echo (isset($_GET['nbPage']) && $_GET['nbPage']== 5) ?'selected': '' ?>>5</option>
                                                    <option value="10" <?php echo (isset($_GET['nbPage']) && $_GET['nbPage']== 10) ?'selected': '' ?>>10</option>
                                                    <option value="15" <?php echo (isset($_GET['nbPage']) && $_GET['nbPage'] == 15) ?'selected': '' ?>>15</option>
                                                    <option value="20" <?php echo (isset($_GET['nbPage']) && $_GET['nbPage']== 20) ?'selected': '' ?>>20</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- pagination boutons -->
                                        <div class="col-lg-3 col-md-3 col-sm-3">                                                                
                                            <ul class="pagination">
                                                <li class="page-item">
                                                    <a <?php echo ($currentPage == 1) ? "" : "href='".$uri."&page=".$currentPage - 1 ."'"?> class="page-link"><span class="glyphicon glyphicon-chevron-left"></span></a>
                                                </li>
                                                <?php for($page = 1; $page <= $pages; $page++): ?>
                                                    <li class="page-item <?php echo ($currentPage == $page) ? "active" : "" ?>">
                                                        <a href="<?php echo $uri.'&page='.$page?>" class="page-link"><?= $page ?></a>
                                                    </li>
                                                <?php endfor ?>
                                                    <li class="page-item" >
                                                    <a <?php echo ($currentPage == $pages) ? "" : "href='".$uri."&page=".$currentPage + 1 ."'"?> class="page-link"><span class="glyphicon glyphicon-chevron-right"></span></a>
                                                </li>
                                            </ul>                                            
                                        </div>
                                        
                                        <!-- liens -->
                                        <div class="col-lg-3 col-lg-offset-1 col-md-3 col-sm-3">
                                            <div class="tableauBouton">                                          
                                                <a href='Customer/view.php' class="btnBlanc"><span class="glyphicon glyphicon-file"></span>&emsp;EXPORTER</a>&emsp;
                                            </div>                                           
                                        </div>                                                
                                    
                                        <!-- liens -->
                                        <div class="col-lg-2 col-md-3 col-sm-3">
                                            <div class="tableauBouton">
                                                <a href='Customer/Insert.php' class="btnOrange">+ AJOUTER</a>
                                            </div>                                           
                                        </div>

                                    </form>
                                
                                </div>
                            
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