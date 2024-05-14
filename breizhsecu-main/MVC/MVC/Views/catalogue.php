<?php 
include("inc/top.php");
?>
<?php
// views/catalogue.php
$produitModel = new Produit($produitModel);
$produits = $produitModel->obtenirTous();
?>
<h1>Catalogue de Produits</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Catégorie</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produits as $produit) : ?>
        <tr>
            <td><?= htmlspecialchars($produit['id']) ?></td>
            <td><?= htmlspecialchars($produit['nom']) ?></td>
            <td><?= htmlspecialchars($produit['prix']) ?></td>
            <td><?= htmlspecialchars($produit['categorie_id']) ?></td>
            <td><a href="produit_detail.php?id=<?= $produit['id'] ?>">Voir</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
include("inc/bottom.php");
?>
