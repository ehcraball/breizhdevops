<?php
// index.php

// Configuration de la base de données
require 'config.php';

// Chargement des modèles
require 'models/Avis.php';
require 'models/Commande.php';
require 'models/Compte.php';
require 'models/Contact.php';
require 'models/Panier.php';
require 'models/Produit.php';

// Chargement des contrôleurs
require 'controllers/AvisController.php';
require 'controllers/CommandeController.php';
require 'controllers/CompteController.php';
require 'controllers/ContactController.php';
require 'controllers/DashboardController.php';
require 'controllers/MesInfosController.php';
require 'controllers/PaiementController.php';
require 'controllers/PanierController.php';
require 'controllers/ProduitController.php';

// Démarrage de la session
session_start();

// Définir les routes
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
	case '/':
		$produitController = new ProduitController(new Produit($db), new Avis($db));
		$produitController->afficherCatalogue();
		break;

	case '/login':
		$compteController = new CompteController(new Compte($db));
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$compteController->login($_POST['email'], $_POST['password']);
		} else {
			require 'views/login.php';
		}
		break;

	case '/register':
		$compteController = new CompteController(new Compte($db));
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$compteController->register($_POST['username'], $_POST['email'], $_POST['password']);
		} else {
			require 'views/register.php';
		}
		break;

	case '/profile':
		$mesInfosController = new MesInfosController(new Compte($db));
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$mesInfosController->updateInfos($_SESSION['user']['id'], $_POST['email'], $_POST['password']);
		} else {
			$userInfo = $mesInfosController->afficherMesInfos($_SESSION['user']['id']);
			require 'views/profile.php';
		}
		break;

	case '/contact':
		$contactController = new ContactController();
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$contactController->processForm();
		} else {
			$contactController->showForm();
		}
		break;

	case '/produit':
		$produitController = new ProduitController(new Produit($db), new Avis($db));
		if (isset($_GET['id'])) {
			$details = $produitController->afficherDetailsProduit($_GET['id']);
			$produit = $details['produit'];
			$avis = $details['avis'];
			require 'views/produit_detail.php';
		} else {
			header('Location: /');
		}
		break;

	case '/commande':
		$commandeController = new CommandeController(new Commande($db), new Commande($db));
		if (isset($_GET['id'])) {
			$commande = $commandeController->afficherDetailsCommande($_GET['id']);
			require 'views/commande_detail.php';
		} else {
			$commandes = $commandeController->afficherCommandesUtilisateur($_SESSION['user']['id']);
			require 'views/commande_list.php';
		}
		break;

	case '/panier':
		$panierController = new PanierController(new Panier($db, $_SESSION['user']['id']));
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST['produit_id']) && isset($_POST['quantite'])) {
				if (isset($_POST['ajouter'])) {
					$panierController->ajouterAuPanier($_POST['produit_id'], $_POST['quantite']);
				} elseif (isset($_POST['supprimer'])) {
					$panierController->supprimerDuPanier($_POST['produit_id']);
				} elseif (isset($_POST['mettreAJour'])) {
					$panierController->mettreAJourQuantite($_POST['produit_id'], $_POST['quantite']);
				}
			}
		} else {
			$panier = $panierController->afficherPanier();
			require 'views/panier.php';
		}
		break;

	case '/payer':
		$paiementController = new PaiementController($paiementModel);
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$paiementController->traiterPaiement($_POST['commande_id'], $_POST['moyenPaiement'], $_POST['cvv']);
		} else {
			require 'views/payer.php';
		}
		break;

	case '/ajouter_avis':
		$avisController = new AvisController(new Avis($db));
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$avisController->ajouter([
				'produit_id' => $_POST['produit_id'],
				'utilisateur' => $_POST['utilisateur'],
				'commentaire' => $_POST['commentaire'],
				'note' => $_POST['note']
			]);
			header('Location: /produit?id=' . $_POST['produit_id']);
		} else {
			require 'views/ajouter_avis.php';
		}
		break;

	case '/mes_avis':
		$avisController = new AvisController(new Avis($db));
		$avis = $avisController->afficherMesAvis($_SESSION['user']['id']);
		require 'views/mes_avis.php';
		break;

	default:
		header("HTTP/1.0 404 Not Found");
		echo '404 Not Found';
		break;
}