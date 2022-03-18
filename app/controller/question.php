<?php

namespace Controller;

if (!empty($_GET) || !empty($_POST)) {
    if (isset($_GET['id'])) {
        include '../../helper/autoloader.php';
    } else {
        include '../helper/autoloader.php';
<<<<<<< HEAD
    }

    public function read()
    {
        return $this->getQuestion();
=======
>>>>>>> 3e0579af6723b829f2708b77c00cb1713f4d1103
    }
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

    public function read($criteria = null)
    {
        return $this->getQuestion($criteria);
    }

    public function questionCount($userId = null)
    {
        return  $this->getQuestionCount($userId);
    }

    public function get_time($time_posted)
    {
        return $this->timestamp($time_posted);
    }
}

!empty($_POST) ? new \Controller\Question($_POST) : null;
