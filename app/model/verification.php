<?php

namespace Model;

use PDOException;

class Verification extends \config\DbConn
{
    // private $postData = [];
    // private $errMsg = [
    //     'title' => '',
    //     'content' => '',
    //     'tag' => '',
    // ];

    // protected function __construct($postData)
    // {
    //     if (!empty($postData)) {
    //         $this->postData = $postData;
    //         $this->checkEmptyInput();

    //         if (array_filter($this->errMsg)) {
    //             return $this->errMsg;
    //         } else {
    //             $this->createQuestion();
    //         }
    //     }
    // }

    // Insert input into database
    protected function acceptVerif()
    {
        session_start();
        // $user = $_SESSION['userId'];
        $sql = "UPDATE user
                SET verification = '1'
                WHERE user_id = $_SESSION[userId];";

        $this->executeQuery($sql, [
            $_SESSION['userId'],
            $this->postData['verification']

        ]);
    }

    // Check for empty inputs
    // private function checkEmptyInput()
    // {
    //     foreach ($this->postData as $field => $data) {
    //         // Check if any input is empty.
    //         if (empty(trim($data))) {
    //             $this->errMsg[$field] = '* ' . ucfirst($field) . ' is a required field';
    //         }
    //     }
    // }
}