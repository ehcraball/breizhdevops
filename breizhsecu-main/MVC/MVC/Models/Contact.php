<?php
class Contact
{
    public $name;
    public $email;
    public $message;

    public function __construct($name, $email, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    // Fonction pour envoyer l'email ou sauvegarder le message
    public function sendMessage()
    {
        // Exemple : envoi d'un e-mail
        $to = "support@monsite.com";
        $subject = "Nouveau message de " . $this->name;
        $headers = "From: " . $this->email;

        $body = "Nom: " . $this->name . "\n";
        $body .= "Email: " . $this->email . "\n";
        $body .= "Message:\n" . $this->message;

        // Utilisation de la fonction mail PHP (ou une autre solution) pour l'envoi
        mail($to, $subject, $body, $headers);
    }
}
