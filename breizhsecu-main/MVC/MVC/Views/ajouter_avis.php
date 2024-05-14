<?php
include("inc/top.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produitId = $_POST['produit_id'];
    $utilisateur = $_POST['utilisateur'];
    $commentaire = $_POST['commentaire'];
    $note = $_POST['note'];

    $resultat = $controller->ajouterAvis($produitId, $utilisateur, $commentaire, $note);

    if ($resultat) {
        echo "Avis ajouté avec succès !";
    } else {
        echo "Erreur lors de l'ajout de l'avis.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
<?php
include("inc/bottom.php");
?>
