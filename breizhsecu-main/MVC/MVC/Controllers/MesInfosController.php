<?php
include("Compte.php");

class MesInfosController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function afficherMesInfos($userId)
    {
        return $this->model->obtenirDetails($userId);
    }

    public function updateInfos($userId, $email, $newPassword = null)
    {
        if ($this->model->updateCompte($userId, $email, $newPassword)) {
            // Redirection appropriée après la mise à jour des informations personnelles
            header("Location: profile.php?success=1");
            exit();
        } else {
            // Gérer l'échec
            header("Location: profile.php?error=1");
            exit();
        }
    }
}
