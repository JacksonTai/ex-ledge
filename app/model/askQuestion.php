<?php

namespace Model;

include '../helper/autoloader.php';

class AskQuestion extends \config\DbConn
{
    private $postData = [];
    private $errMsg = [
        'title' => '',
        'content' => '',
        'tag' => '',
    ];

    protected function __construct($postData)
    {
        $this->postData = $postData;
        $this->checkEmptyInput();
        
        if (array_filter($this->errMsg)) {
            return $this -> errMsg;
        } else {
            $this->createQuestion();
        }
    } 

    protected function createQuestion()
    {   

        $questionId = uniqid('Q');
        $sql = "INSERT INTO question
                VALUES (?, ?, ?, ?, ?, ?);";

        $this->executeQuery($sql, [
            $questionId,
            "U622622cfcdfac",
            $this->postData['title'],
            $this->postData['content'],
            $this->postData['tag'],
            0
        ]);
    }

    private function checkEmptyInput()
    {
        $result = true;
        foreach ($this->postData as $field => $data) {

            // Check if any input is empty.
            if (empty(trim($data))) {
                $this->errMsg[$field] = '* ' . ucfirst($field) . ' is a required field';
            }
        }
        return $result;
    }

}