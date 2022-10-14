<div id='navbar'>
    <div>
        <?php
        if (file_exists("img\logo.png"))
            echo '<img src="img\logo.png" class="navbar-brand">';
        else
        echo '<img src="..\img\logo.png" class="navbar-brand">';
        ?>  
        <span class="glyphicon glyphicon-menu-hamburger" style="color: #fff" id="gly1"></span>          
    </div>
</div>