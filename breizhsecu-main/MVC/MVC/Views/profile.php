<?php 
include("inc/top.php");
?>
<h1>Mon Profil</h1>
<p>Nom d'utilisateur : <?= htmlspecialchars($_SESSION['user']['username']) ?></p>
<p>Email : <?= htmlspecialchars($_SESSION['user']['email']) ?></p>
<form action="update_profile.php" method="post">
    <label for="email">Nouveau Email :</label>
    <input type="email" id="email" name="email">
    
    <label for="password">Nouveau Mot de passe :</label>
    <input type="password" id="password" name="password">
    
    <input type="submit" value="Mettre à jour">
</form>
<?php
include("inc/bottom.php");
?>
