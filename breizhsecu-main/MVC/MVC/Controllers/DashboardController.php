<?php
class DashboardController {
    private $userModel;
    private $productModel;
    private $reviewModel;

    public function __construct($userModel, $productModel, $reviewModel) {
        $this->userModel = $userModel;
        $this->productModel = $productModel;
        $this->reviewModel = $reviewModel;
    }

    public function index() {
        session_start();
        if (!isset($_SESSION['iduser'])) {
            header("Location: connecter.php");
            exit;
        }
        $userInfo = $this->userModel->getUserInfo($_SESSION['iduser']);
        $products = $this->productModel->getProducts();
        $reviews = $this->reviewModel->getReviewsByUser($_SESSION['iduser']);
        include("views/accueil.php");
    }
}
