<?php 
include("inc/top.php");
?>
<form action="register_action.php" method="post">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="username" name="username" required>
    
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required>
    
    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>
    
    <input type="submit" value="S'inscrire">
</form>
<?php
include("inc/bottom.php");
?>
