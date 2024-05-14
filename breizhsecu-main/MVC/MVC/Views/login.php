<?php
include("inc/top.php");
?>
<form method="post" action="authenticate.php">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>

    <input type="submit" value="Se connecter">
</form>
<?php
include("inc/bottom.php");
?>