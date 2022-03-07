<?php

namespace Controller;

include '../helper/autoloader.php';

class AskQuestion extends \Model\AskQuestion
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

new \Controller\AskQuestion($_POST);
