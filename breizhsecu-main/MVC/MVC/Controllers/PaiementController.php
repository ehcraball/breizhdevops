<?php
class PaiementController {
    private $paiementModel;

    public function __construct($paiementModel) {
        $this->paiementModel = $paiementModel;
    }

    public function showForm($commandeId, $montantTotal, $error = null) {
        include("views/payer.php");
    }

    public function processPayment($commandeId, $cb, $validite, $crypto) {
        try {
            // Valider les données de la carte
            $this->validatePaymentDetails($cb, $validite, $crypto);

            // Tenter de traiter le paiement via le modèle
            if ($this->paiementModel->processPayment($commandeId, $cb, $validite, $crypto)) {
                header("Location: acquitter.php?commande=" . $commandeId);
                exit;
            } else {
                throw new Exception("Paiement refusé par la banque");
            }
        } catch (Exception $e) {
            // Gérer les erreurs et rediriger vers le formulaire de paiement avec un message d'erreur
            header("Location: payer.php?commande=" . $commandeId . "&error=" . urlencode($e->getMessage()));
            exit;
        }
    }
    public function traiterPaiement($numCarte, $dateExpiration, $cvv) {
        // Simuler une validation de carte de crédit
        if ($this->validerCarte($numCarte, $dateExpiration, $cvv)) {
            // Simuler un traitement réussi
            return ['success' => true, 'message' => 'Paiement réussi'];
        } else {
            // Simuler un échec de traitement
            return ['success' => false, 'message' => 'Paiement échoué'];
        }
    }
    private function validerCarte($numCarte, $dateExpiration, $cvv) {
        // Exemple de validation très basique
        return !empty($numCarte) && !empty($dateExpiration) && !empty($cvv);
    }

    private function validatePaymentDetails($cb, $validite, $crypto) {

        return true;
    }
}
