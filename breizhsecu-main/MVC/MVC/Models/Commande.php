<?php 
// models/Commande.php
class Commande {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Crée une nouvelle commande
    public function creer($userId, $produits, $total) {
        $stmt = $this->db->prepare("INSERT INTO commandes (user_id, total, date) VALUES (:userId, :total, NOW())");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':total', $total);
        $stmt->execute();
        $commandeId = $this->db->lastInsertId();

        foreach ($produits as $produit) {
            $stmt = $this->db->prepare("INSERT INTO commande_produits (commande_id, produit_id, quantite, prix) VALUES (:commandeId, :produitId, :quantite, :prix)");
            $stmt->bindParam(':commandeId', $commandeId, PDO::PARAM_INT);
            $stmt->bindParam(':produitId', $produit['id'], PDO::PARAM_INT);
            $stmt->bindParam(':quantite', $produit['quantite'], PDO::PARAM_INT);
            $stmt->bindParam(':prix', $produit['prix']);
            $stmt->execute();
        }

        return $commandeId;
    }

    // Récupère les commandes d'un utilisateur
    public function obtenirParUtilisateur($userId) {
        $stmt = $this->db->prepare("SELECT * FROM commandes WHERE user_id = :userId ORDER BY date DESC");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère les détails d'une commande spécifique
    public function obtenirDetails($commandeId) {
        $stmt = $this->db->prepare("SELECT * FROM commandes WHERE id = :commandeId");
        $stmt->bindParam(':commandeId', $commandeId, PDO::PARAM_INT);
        $stmt->execute();
        $commande = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($commande) {
            $stmt = $this->db->prepare("SELECT * FROM commande_produits WHERE commande_id = :commandeId");
            $stmt->bindParam(':commandeId', $commandeId, PDO::PARAM_INT);
            $stmt->execute();
            $commande['produits'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $commande;
    }
    public function mettreAJourStatut($commandeId, $statut) {
        $stmt = $this->db->prepare("UPDATE commande SET statut = :statut WHERE idcde = :commandeId");
        $stmt->bindParam(':statut', $statut);
        $stmt->bindParam(':commandeId', $commandeId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
