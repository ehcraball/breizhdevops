<?php 
include("inc/top.php");
?>
<h1>Mes Commandes</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($commandes as $commande) : ?>
        <tr>
            <td><?= htmlspecialchars($commande['id']) ?></td>
            <td><?= htmlspecialchars($commande['date']) ?></td>
            <td><?= htmlspecialchars($commande['total']) ?></td>
            <td><a href="commande_detail.php?id=<?= $commande['id'] ?>">Voir</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
include("inc/bottom.php");
?>

