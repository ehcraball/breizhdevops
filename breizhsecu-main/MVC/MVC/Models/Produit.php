<?php 
// models/Produit.php
class Produit {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Récupère tous les produits du catalogue
    public function obtenirTous() {
        $stmt = $this->db->prepare("SELECT * FROM produits");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère les détails d'un produit spécifique
    public function obtenirDetails($produitId) {
        $stmt = $this->db->prepare("SELECT * FROM produits WHERE id = :produitId");
        $stmt->bindParam(':produitId', $produitId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupère les produits par catégorie
    public function obtenirParCategorie($categorieId) {
        $stmt = $this->db->prepare("SELECT * FROM produits WHERE categorie_id = :categorieId");
        $stmt->bindParam(':categorieId', $categorieId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
