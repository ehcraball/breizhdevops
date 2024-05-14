<?php
// controllers/PanierController.php
class PanierController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    // Ajoute un produit au panier
    public function ajouterAuPanier($produitId, $quantite) {
        return $this->model->ajouter($produitId, $quantite);
    }

    // Met à jour la quantité d'un produit dans le panier
    public function mettreAJourQuantite($produitId, $quantite) {
        return $this->model->mettreAJour($produitId, $quantite);
    }

    // Supprime un produit du panier
    public function supprimerDuPanier($produitId) {
        return $this->model->supprimer($produitId);
    }

    // Affiche le contenu du panier
    public function afficherPanier() {
        return $this->model->obtenirContenu();
    }
}
