<?php

namespace Controller;

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

    public function questionCount($userId = null)
    {
        return  $this->getQuestionCount($userId);
    }
}

!empty($_POST) ? new \Controller\Question($_POST) : null;
