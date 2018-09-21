<?php

include_once ROOT . '/controllers/Controller.php';
include_once ROOT . '/models/Model_Contact.php';


class ContactController extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->contactModel = new Model_Contact();
    }

    public function actionIndex() {
        try {
            function clean($value = "") {
                $value = trim($value);
                $value = stripslashes($value);
                $value = strip_tags($value);
                $value = htmlspecialchars($value);

                return $value;
            }
            $result = true;

            if (isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && $_POST['message']) {
                $_POST['name'] = clean($_POST['name']);
                $_POST['email'] = clean($_POST['email']);
                $_POST['subject'] = clean($_POST['subject']);
                $_POST['message'] = clean($_POST['message']);
                $this->contactModel->setContactMessage($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);
            } else {
                $result = false;
            }

            $this->view->result = $result;
            $this->view->generate('template_view.phtml', 'contact/contact.phtml');
            header("Location: /contact" );
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return true;
    }
}