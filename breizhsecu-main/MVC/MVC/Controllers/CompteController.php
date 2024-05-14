<?php 
include("Compte.php");
// controllers/CompteController.php
class CompteController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function register($username, $email, $password) {
        if ($this->model->register($username, $email, $password)) {
            header("Location: login.php");
        } else {
            // Gérer l'échec
        }
    }

    public function login($username, $password) {
        $user = $this->model->login($username, $password);
        if ($user) {
            session_start();
            $_SESSION['user'] = $user;
            header("Location: profile.php");
        } else {
            // Gérer l'échec
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: login.php");
    }

    public function updateProfile($userId, $email, $newPassword = null) {
        return $this->model->updateProfile($userId, $email, $newPassword);
    }
}
