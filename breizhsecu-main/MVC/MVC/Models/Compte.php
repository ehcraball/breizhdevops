<?php
// models/Compte.php
class Compte
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Crée un nouveau compte utilisateur
    public function creer($nom, $email, $motDePasse)
    {
        $stmt = $this->db->prepare("INSERT INTO comptes (nom, email, mot_de_passe) VALUES (:nom, :email, :motDePasse)");
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':motDePasse', password_hash($motDePasse, PASSWORD_BCRYPT), PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Authentifie un utilisateur
    public function authentifier($email, $motDePasse)
    {
        $stmt = $this->db->prepare("SELECT * FROM comptes WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($motDePasse, $user['mot_de_passe'])) {
            return $user;
        }
        return false;
    }

    // Récupère les détails d'un compte utilisateur
    public function obtenirDetails($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM comptes WHERE id = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Met à jour les informations du compte utilisateur
    public function updateCompte($userId, $email, $newPassword = null)
    {
        if ($newPassword) {
            $stmt = $this->db->prepare("UPDATE comptes SET email = :email, mot_de_passe = :motDePasse WHERE id = :userId");
            $stmt->bindParam(':motDePasse', password_hash($newPassword, PASSWORD_BCRYPT), PDO::PARAM_STR);
        } else {
            $stmt = $this->db->prepare("UPDATE comptes SET email = :email WHERE id = :userId");
        }
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
