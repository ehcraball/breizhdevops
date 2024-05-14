<?php
include('Avis.php'); // Assure-toi que le chemin est correct

class AvisController
{
    private $avisModel;

    public function __construct($avisModel)
    {
        $this->avisModel = $avisModel;
    }

    public function afficherMesAvis($userId)
    {
        return $this->avisModel->getAvisByUserId($userId);
    }
    public function ajouter($userId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $commentaire = $_POST['commentaire'] ?? '';
            $note = $_POST['note'] ?? '';
            $this->avisModel->ajouterAvis($userId, $commentaire, $note);
            header('Location: /mes_avis');
            exit;
        }
    }
}
