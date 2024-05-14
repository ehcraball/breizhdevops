<?php
include 'Commande.php';
// controllers/CommandeController.php
class CommandeController {
    private $model;
    private $commandeModel;

    public function __construct($model, $commandeModel) {
        $this->model = $model;
        $this->commandeModel = $commandeModel;
    }

    // Crée une nouvelle commande pour l'utilisateur actuel
    public function creerNouvelleCommande($userId, $produits, $total) {
        return $this->model->creer($userId, $produits, $total);
    }

    // Récupère et affiche toutes les commandes de l'utilisateur
    public function afficherCommandesUtilisateur($userId) {
        return $this->model->obtenirParUtilisateur($userId);
    }

    // Récupère et affiche les détails d'une commande spécifique
    public function afficherDetailsCommande($commandeId) {
        return $this->model->obtenirDetails($commandeId);
    }
    public function acquitterCommande($commandeId) {
        $statut = "Payee";
        $this->commandeModel->mettreAJourStatut($commandeId, $statut);
        $_SESSION['PANIER'] = "";
        header("Location: commande.php?payee&commande=" . $commandeId);
        exit;
    }
}
