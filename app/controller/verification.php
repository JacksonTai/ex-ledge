<?php

namespace Controller;

if (!empty($_GET) || !empty($_POST)) {
    if (isset($_GET['id'])) {
        include '../../helper/autoloader.php';
    } else {
        include '../helper/autoloader.php';
    }
}

class Verification extends \Model\Verification
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

    public function read($criteria = null)
    {
        return $this->getVerif($criteria);
    }

    // public function questionCount($userId = null)
    // {
    //     return  $this->getQuestionCount($userId);
    // }
}

!empty($_POST) ? new \Controller\Verification($_POST) : null;
