<?php

namespace Controller;

if (!empty($_GET) || !empty($_POST)) {
    if (isset($_GET['id'])) {
        include '../../helper/autoloader.php';
    } else {
        session_start();
        include '../helper/autoloader.php';
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

    /* ######### READ ######### */
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

    public function loadQuestions($limit, $start)
    {
        return $this->loadData($limit, $start);
    }     

    /* ######### DELETE ######### */
    public function delete($questionId)
    {
        $this->deleteQuestion($questionId);
    }
}

if (!empty($_POST)) {
    if (!isset($_POST["limit"], $_POST["start"])){
        new \Controller\Question($_POST);
    }
} else {
    null;
}

/* ######### READ ######### */
if (isset($_POST["limit"], $_POST["start"])){
    $question = new \Controller\Question();
    return $question -> loadQuestions($_POST["limit"], $_POST["start"]);
}

/* ######### DELETE ######### */
if (isset($_GET['deleteId'])) {
    $user = new \Controller\Question();
    $user->delete($_GET['deleteId']);
}