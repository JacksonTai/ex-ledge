<?php

namespace Model;
 
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
                VALUES (?, ?, ?, ?, ?, ?, NOW());";

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

    protected function getQuestionCount($userId)
    {
        $sql = "SELECT COUNT(question_id) FROM question
                   WHERE `user_id` = ?";
        $stmt = $this->executeQuery($sql, [$userId]);
        $result = $stmt->fetch();
        return $result['COUNT(question_id)'];
    }
}
