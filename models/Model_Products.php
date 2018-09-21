<?php

class Model_Products extends Db {

    public function __construct() {
        parent::__construct();
    }


    public function getProductsList() {                                           // для получения всех новостей (используем таблицу category для получения названия категории и подставления в ссылку для ЧПУ)
        $sql = $this->connection->prepare("SELECT * FROM products LIMIT 6");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

}