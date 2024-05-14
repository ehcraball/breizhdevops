<?php
include("inc/top.php");
?>
<div class="well well-small">
    <h3>Mon compte</h3>
    <hr class="soften" />
    <div class="row-fluid">
        <ul class="thumbnails">
            <li class="span4">
                <div class="thumbnail">
                    <a href="mesinfos.php"><img src="http://localhost/breizhsecu/images/comptes/<?php echo $userInfo['username']; ?>.jpg" alt=""></a>
                    <div class="caption">
                        <a href="mesinfos.php">
                            <h5>Mes infos</h5>
                        </a>
                    </div>
                </div>
            </li>
            <li class="span4">
                <div class="thumbnail">
                    <a href="MVC\Views\commande_list.php"><img src="images/divers/commandes.jpg" alt="" /></a>
                    <div class="caption">
                        <a href="MVC\Views\commande_list.php">
                            <h5>Mes commandes</h5>
                        </a>
                    </div>
                </div>
            </li>
            <li class="span4">
                <div class="thumbnail">
                    <a href="MVC\Views\mes_avis.php"><img src="images/divers/avis.jpg" alt="" /></a>
                    <div class="caption">
                        <a href="MVC\Views\mes_avis.php">
                            <h5>Mes avis</h5>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<?php
include("inc/bottom.php");
?>