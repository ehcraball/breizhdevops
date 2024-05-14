<?php 
include("inc/top.php");
?>
<?php
// Inclure le contrôleur de paiement
include_once 'PaiementController.php';
$paiementController = new PaiementController($paiementModel);

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $numCarte = $_POST['numCarte'];
    $dateExpiration = $_POST['dateExpiration'];
    $cvv = $_POST['cvv'];

    // Appeler la méthode de traitement du paiement
    $resultat = $paiementController->traiterPaiement($numCarte, $dateExpiration, $cvv);

    // Afficher le résultat
    if ($resultat) {
        echo "Paiement réussi";
    } else {
        echo "Échec du paiement";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Paiement</title>
</head>
<body>
    <h1>Page de Paiement</h1>
    <form action="payer.php" method="post">
        <label for="numCarte">Numéro de Carte :</label>
        <input type="text" id="numCarte" name="numCarte" required><br>

        <label for="dateExpiration">Date d'Expiration :</label>
        <input type="text" id="dateExpiration" name="dateExpiration" required><br>

        <label for="cvv">CVV :</label>
        <input type="text" id="cvv" name="cvv" required><br>

        <input type="submit" value="Payer">
    </form>
</body>
</html>
<?php
include("inc/bottom.php");
?>
