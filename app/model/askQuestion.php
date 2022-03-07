<?php

namespace Model;

include '../../helper/autoloader.php';

class AskQuestion extends \config\DbConn
{
    private $postData = [];

    protected function __construct($postData)
    {
        $this->postData = $postData;
        $this->createQuestion();
    } 

    protected function createQuestion()
    {   

        $questionId = uniqid('Q');
        $sql = "INSERT INTO question
                VALUES (?, ?, ?, ?, ?, ?);";

        $this->executeQuery($sql, [
            $questionId,
            $_SESSION['userId'],
            $this->postData['title'],
            $this->postData['content'],
            $this->postData['tag'],
            0
        ]);


    }

}