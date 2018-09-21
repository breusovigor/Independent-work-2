<?php

class Model_Categories extends Db
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getCategories() {
        $sql = $this->connection->prepare("SELECT * FROM categories");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getShipperName() {
        $sql = $this->connection->prepare("SELECT * FROM shippers");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryProducts($category) {
        $sql = $this->connection->prepare("SELECT * FROM products INNER JOIN categories ON products.category_id = categories.category_id WHERE category_code = :category");
        $sql->bindParam(':category', $category, PDO::PARAM_STR);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}