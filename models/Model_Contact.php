<?php

class Model_Contact extends Db
{
    public function __construct() {
        parent::__construct();
    }

    public function setContactMessage($userName, $userEmail, $subject, $messageText) {
        $sql = $this->connection->prepare("INSERT INTO `contacts`(`user_name`, `user_email`, `subject`, 
                                  `message_text`) VALUES (:name, :email, :subject, :text)");
        $sql->bindParam(':name', $userName, PDO::PARAM_STR);
        $sql->bindParam(':email', $userEmail, PDO::PARAM_STR);
        $sql->bindParam(':subject', $subject, PDO::PARAM_STR);
        $sql->bindParam(':text', $messageText, PDO::PARAM_STR);
        $sql->execute();
    }
}