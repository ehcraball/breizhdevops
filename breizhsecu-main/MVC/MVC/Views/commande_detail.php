<?php 
include("inc/top.php");
?>
<h1>Détails de la Commande</h1>
<p>ID : <?= htmlspecialchars($commande['id']) ?></p>
<p>Date : <?= htmlspecialchars($commande['date']) ?></p>
<p>Total : <?= htmlspecialchars($commande['total']) ?></p>

<h2>Produits</h2>
<table>
    <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($commande['produits'] as $produit) : ?>
        <tr>
            <td><?= htmlspecialchars($produit['produit_id']) ?></td>
            <td><?= htmlspecialchars($produit['quantite']) ?></td>
            <td><?= htmlspecialchars($produit['prix']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
include("inc/bottom.php");
?>