<?php
require_once("models/Contact.php");

class ContactController
{
    public function showForm()
    {
        include "views/contact.php";
    }

    public function processForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $message = $_POST['message'] ?? '';

            // Créer une instance du modèle Contact
            $contact = new Contact($name, $email, $message);

            // Envoi du message
            $contact->sendMessage();

            // Rediriger ou afficher un message de confirmation
            header("Location: contact_confirmation.php");
            exit;
        }
    }
}
