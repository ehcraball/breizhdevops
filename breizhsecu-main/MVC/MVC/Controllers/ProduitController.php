<?php 
// controllers/ProduitController.php
class ProduitController {
    private $produitModel;
    private $avisModel;

    public function __construct($produitModel, $avisModel) {
        $this->produitModel = $produitModel;
        $this->avisModel = $avisModel;
    }

    // Récupère et affiche tous les produits du catalogue
    public function afficherCatalogue() {
        return $this->produitModel->obtenirTous();
    }

    // Récupère et affiche les détails d'un produit spécifique
    public function afficherDetailsProduit($produitId) {
        $produit = $this->produitModel->obtenirDetails($produitId);
        $avis = $this->avisModel->obtenirPourProduit($produitId);
        return ['produit' => $produit, 'avis' => $avis];
    }

    // Récupère et affiche les produits d'une catégorie donnée
    public function afficherProduitsParCategorie($categorieId) {
        return $this->produitModel->obtenirParCategorie($categorieId);
    }
    public function ajouterAvis($produitId, $utilisateur, $commentaire, $note) {
        return $this->avisModel->ajouter($produitId, $utilisateur, $commentaire, $note);
    }
}
