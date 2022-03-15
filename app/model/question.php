<?php

namespace Model;

use PDOException;

class Question extends \config\DbConn
{
    private $postData = [];
    private $errMsg = [
        'title' => '',
        'content' => '',
        'tag' => '',
    ];

    protected function __construct($postData)
    {
        if (!empty($postData)) {
            $this->postData = $postData;
            $this->checkEmptyInput();

            if (array_filter($this->errMsg)) {
                return $this->errMsg;
            } else {
                $this->createQuestion();
            }
        }
    }

    // Insert input into database
    protected function createQuestion()
    {
        session_start();
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

    // Check for empty inputs
    private function checkEmptyInput()
    {
        foreach ($this->postData as $field => $data) {
            // Check if any input is empty.
            if (empty(trim($data))) {
                $this->errMsg[$field] = '* ' . ucfirst($field) . ' is a required field';
            }
        }
    }

    protected function getQuestion()
    {
        try {
            $result = [];
            $sql = "SELECT * FROM question q
                    INNER JOIN user u ON
                    q.user_id = u.user_id";
            $stmt = $this->executeQuery($sql);
            $allQuestions = $stmt->fetchAll();

        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }

        return $allQuestions;
    }
}
