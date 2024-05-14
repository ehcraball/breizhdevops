<?php 
include("inc/top.php");
?>
<h1>Votre Panier</h1>
<table>
    <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
            <th>Prix Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total = 0;
        foreach ($panier as $item) :
            $prixTotal = $item['prix'] * $item['quantite'];
            $total += $prixTotal;
        ?>
        <tr>
            <td><?= htmlspecialchars($item['nom']) ?></td>
            <td><?= htmlspecialchars($item['quantite']) ?></td>
            <td><?= htmlspecialchars($item['prix']) ?></td>
            <td><?= htmlspecialchars($prixTotal) ?></td>
            <td>
                <a href="mettre_a_jour_quantite.php?id=<?= $item['id'] ?>&action=incrementer">+</a>
                <a href="mettre_a_jour_quantite.php?id=<?= $item['id'] ?>&action=decrementer">-</a>
                <a href="supprimer_du_panier.php?id=<?= $item['id'] ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">Total</td>
            <td><?= htmlspecialchars($total) ?></td>
            <td></td>
        </tr>
    </tfoot>
</table>
<?php
include("inc/bottom.php");
?>
