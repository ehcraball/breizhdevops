<?php
// models/Avis.php
class Avis
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Récupère tous les avis pour un produit spécifique
    public function obtenirPourProduit($produitId)
    {
        $stmt = $this->db->prepare("SELECT * FROM avis WHERE produit_id = :produitId");
        $stmt->bindParam(':produitId', $produitId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajoute un avis pour un produit
    public function ajouter($produitId, $utilisateur, $commentaire, $note)
    {
        $stmt = $this->db->prepare("INSERT INTO avis (produit_id, utilisateur, commentaire, note) VALUES (:produitId, :utilisateur, :commentaire, :note)");
        $stmt->bindParam(':produitId', $produitId, PDO::PARAM_INT);
        $stmt->bindParam(':utilisateur', $utilisateur, PDO::PARAM_STR);
        $stmt->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
        $stmt->bindParam(':note', $note, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function getAvisByUserId($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM avis WHERE idcompte = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
