<?php
// models/Panier.php
class Panier {
    private $db;
    private $userId;

    public function __construct($db, $userId) {
        $this->db = $db;
        $this->userId = $userId;
    }

    // Ajoute un produit au panier
    public function ajouter($produitId, $quantite) {
        $stmt = $this->db->prepare("INSERT INTO panier (user_id, produit_id, quantite) VALUES (:userId, :produitId, :quantite) ON DUPLICATE KEY UPDATE quantite = quantite + :quantite");
        $stmt->bindParam(':userId', $this->userId, PDO::PARAM_INT);
        $stmt->bindParam(':produitId', $produitId, PDO::PARAM_INT);
        $stmt->bindParam(':quantite', $quantite, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Met à jour la quantité d'un produit dans le panier
    public function mettreAJour($produitId, $quantite) {
        $stmt = $this->db->prepare("UPDATE panier SET quantite = :quantite WHERE user_id = :userId AND produit_id = :produitId");
        $stmt->bindParam(':userId', $this->userId, PDO::PARAM_INT);
        $stmt->bindParam(':produitId', $produitId, PDO::PARAM_INT);
        $stmt->bindParam(':quantite', $quantite, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprime un produit du panier
    public function supprimer($produitId) {
        $stmt = $this->db->prepare("DELETE FROM panier WHERE user_id = :userId AND produit_id = :produitId");
        $stmt->bindParam(':userId', $this->userId, PDO::PARAM_INT);
        $stmt->bindParam(':produitId', $produitId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Récupère le contenu du panier de l'utilisateur
    public function obtenirContenu() {
        $stmt = $this->db->prepare("SELECT p.id, p.nom, p.prix, panier.quantite FROM panier JOIN produits p ON panier.produit_id = p.id WHERE panier.user_id = :userId");
        $stmt->bindParam(':userId', $this->userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
