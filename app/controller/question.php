<?php

namespace Controller;

include '../helper/autoloader.php';

class Question extends \Model\Question
{
    public function __construct($postData)
    {
        $errMsg = parent::__construct($postData);
        if (is_array($errMsg)) {
            echo json_encode($errMsg);
        } else {
            echo json_encode(false);
        }
    }
}

new \Controller\Question($_POST);
