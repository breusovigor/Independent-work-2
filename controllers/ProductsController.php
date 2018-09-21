<?php

include_once ROOT . '/models/Model_Products.php';
include_once ROOT . '/models/Model_Categories.php';
include_once ROOT . '/controllers/Controller.php';

class ProductsController extends Controller {

    private $productsModel;
    private $categoriesModel;

    function __construct()
    {
        parent::__construct();
        $this->productsModel = new Model_Products();
        $this->categoriesModel = new Model_Categories();
    }

    public function actionIndex($category = NULL) {
        try {
            if ($category == NULL) {
                $result = $this->productsModel->getProductsList();
            } else {
                $result = $this->categoriesModel->getCategoryProducts($category);
            }
            $this->view->products = $result;
            $this->view->categories = $this->categoriesModel->getCategories();
            $this->view->shippers = $this->categoriesModel->getShipperName();
            $this->view->generate('template_view.phtml', 'products/products.phtml');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return true;
    }

    public function actionDetail() {
        try {
            $this->view->generate('template_view.phtml', 'products/detail.phtml');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return true;
    }

}
?>