<?php
session_start();
include('AvisController.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirige vers la page de connexion si non connecté
    exit();
}

$db = new PDO('mysql:host=localhost;dbname=nom_de_ta_bdd', 'username', 'password'); // Configure selon ton environnement
$avisModel = new Avis($db);
$avisController = new AvisController($avisModel);
$mesAvis = $avisController->afficherMesAvis($_SESSION['user_id']);

include('header.php'); // Si tu as un fichier d'en-tête
?>

<h1>Mes Avis</h1>
<div>
    <?php foreach ($mesAvis as $avis) : ?>
        <div class="avis">
            <h3><?= htmlspecialchars($avis['titre']) ?></h3>
            <p><?= htmlspecialchars($avis['texte']) ?></p>
            <p>Date: <?= htmlspecialchars($avis['date']) ?></p>
        </div>
    <?php endforeach; ?>
</div>

<?php include('footer.php'); // Si tu as un fichier de pied de page 
?>