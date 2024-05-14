<?php 
include("inc/top.php");
?>
<?php
include_once 'ProduitModel.php';
include_once 'AvisModel.php';

$produitModel = new Produit($produitModel);
$avisModel = new Avis($avisModel);

// Récupérer l'ID du produit à partir de la requête GET
$id_produit = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Charger les données du produit et des avis
$produit = $produitModel->obtenirDetails($id_produit);
$avis = $avisModel->obtenirPourProduit($id_produit);
?>

<h1>Détails du Produit</h1>
<p>ID : <?= htmlspecialchars($produit['id']) ?></p>
<p>Nom : <?= htmlspecialchars($produit['nom']) ?></p>
<p>Description : <?= htmlspecialchars($produit['description']) ?></p>
<p>Prix : <?= htmlspecialchars($produit['prix']) ?></p>
<p>Catégorie : <?= htmlspecialchars($produit['categorie_id']) ?></p>

<a href="ajouter_au_panier.php?id=<?= $produit['id'] ?>">Ajouter au panier</a>

<h2>Avis</h2>
<ul>
    <?php foreach ($avis as $singleAvis) : ?>
    <li>
        <strong><?= htmlspecialchars($singleAvis['utilisateur']) ?> (<?= htmlspecialchars($singleAvis['note']) ?>/5) :</strong>
        <?= htmlspecialchars($singleAvis['commentaire']) ?>
    </li>
    <?php endforeach; ?>
</ul>

<h3>Laisser un avis</h3>
<form action="ajouter_avis.php" method="POST">
    <input type="hidden" name="produit_id" value="<?= htmlspecialchars($produit['id']) ?>">
    <label>Utilisateur : <input type="text" name="utilisateur"></label><br>
    <label>Note : <input type="number" name="note" min="1" max="5"></label><br>
    <label>Commentaire : <textarea name="commentaire"></textarea></label><br>
    <input type="submit" value="Envoyer">
</form>
<?php
include("inc/bottom.php");
?>

