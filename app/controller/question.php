<?php

namespace Controller;

if (!empty($_GET) || !empty($_POST)) {
    include '../helper/autoloader.php';
}

class Question extends \Model\Question
{
    public function __construct($postData = null)
    {
        if ($postData) {
            $errMsg = parent::__construct($postData);
            if (is_array($errMsg)) {
                echo json_encode($errMsg);
            } else {
                echo json_encode(false);
            }
        }
    }

    public function read()
    {
        return $this->getQuestion();
    }
}

!empty($_POST) ? new \Controller\Question($_POST) : null;
