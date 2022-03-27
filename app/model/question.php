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
        //session_start();
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


    /* ######### READ ######### */
    protected function getQuestion($criteria, $limit, $start)
    {
        if ($criteria) {
            try {
                if (!is_array($criteria)) {
                    // Query for selecting questions of specific user.
                    if ($criteria[0] == 'U') {
                        $sql = "SELECT *, q.point AS point, u.POINT AS u_point
                                FROM question q INNER JOIN user u ON q.user_id = u.user_id
                                WHERE q.user_id = ?;";
                    }
                    if ($criteria[0] == 'Q') {
                        $sql = "SELECT *, q.point AS point, u.POINT AS u_point
                                FROM question q INNER JOIN user u ON q.user_id = u.user_id
                                WHERE q.question_id = ?;";
                    }
                    $stmt = $this->executeQuery($sql, [$criteria]);
                    return $stmt->fetchAll();
                }

                // Filter question.
                if (is_array($criteria) && isset($limit, $start)) {

                    // Store the result of filtered questions.
                    $filterResults = [];

                    /* ========================================= Latest ========================================= */
                    if (isset($_GET['sort']) && $_GET['sort'] == 'latest') {

                        // User entered search text for tags or keywords.
                        if (isset($_GET['searchTxt']) && $_GET['searchTxt'] != '') {

                            if ($_GET['search'] == 'tag') {
                                // User searched question based on tags.
                                $sql = "SELECT q.*, u.username, u.user_id FROM question q
                                            INNER JOIN user u ON q.user_id = u.user_id
                                            WHERE q.tag = ?
                                            ORDER BY time_posted DESC 
                                            LIMIT $limit OFFSET $start;";
                                $stmt = $this->executeQuery($sql, [$_GET['searchTxt']]);
                                return $stmt->fetchAll();

                                // User searched question that has no answer based on tags.
                                if (isset($_GET['noAns'])) {
                                    $sql = "SELECT q.*, u.username, u.user_id FROM question q
                                                INNER JOIN user u ON
                                                q.user_id = u.user_id
                                                WHERE q.question_id NOT IN (SELECT question_id FROM answer)
                                                AND q.tag = ?
                                                ORDER BY q.time_posted DESC LIMIT $limit OFFSET $start;";
                                    $stmt = $this->executeQuery($sql, [$_GET['searchTxt']]);
                                    return $stmt->fetchAll();
                                }

                                /* User searched question that has no accepted answer or 
                                   no answer and accepted answer based on tags. */
                                if (isset($_GET['noAcceptedAns']) || isset($_GET['noAns'], $_GET['noAcceptedAns'])) {
                                    $sql = "SELECT q.*, u.username, u.user_id FROM question q
                                                INNER JOIN user u ON
                                                q.user_id = u.user_id
                                                WHERE q.question_id NOT IN (SELECT question_id FROM answer WHERE `status` = 1)
                                                AND q.tag = ?
                                                ORDER BY q.time_posted DESC LIMIT $limit OFFSET $start;";
                                    $stmt = $this->executeQuery($sql, [$_GET['searchTxt']]);
                                    return $stmt->fetchAll();
                                }
                            }

                            if ($_GET['search'] == 'keyword') {
                                // User searched question based on keywords.
                                $sql = "SELECT q.*, u.username, u.user_id FROM question q
                                                INNER JOIN user u ON q.user_id = u.user_id
                                                WHERE q.content LIKE ? OR q.title LIKE ?
                                                ORDER BY time_posted DESC 
                                                LIMIT $limit OFFSET $start;";
                                $stmt = $this->executeQuery($sql, [
                                    '%' . $_GET['searchTxt'] . '%',
                                    '%' . $_GET['searchTxt'] . '%'
                                ]);
                                return $stmt->fetchAll();

                                // User searched question that has no answer based on keywords.
                                if (isset($_GET['noAns'])) {
                                    $sql = "SELECT q.*, u.username, u.user_id FROM question q
                                                INNER JOIN user u ON
                                                q.user_id = u.user_id
                                                WHERE q.question_id NOT IN (SELECT question_id FROM answer)
                                                AND q.content LIKE ? OR q.title LIKE ?
                                                ORDER BY q.time_posted DESC LIMIT $limit OFFSET $start;";
                                    $stmt = $this->executeQuery($sql, [
                                        '%' . $_GET['searchTxt'] . '%',
                                        '%' . $_GET['searchTxt'] . '%'
                                    ]);
                                    return $stmt->fetchAll();
                                }

                                /* User searched question that has no accepted answer or 
                                   no answer and accepted answer based on keywords. */
                                if (isset($_GET['noAcceptedAns']) || isset($_GET['noAns'], $_GET['noAcceptedAns'])) {
                                    $sql = "SELECT q.*, u.username, u.user_id FROM question q
                                                INNER JOIN user u ON
                                                q.user_id = u.user_id
                                                WHERE q.question_id NOT IN (SELECT question_id FROM answer WHERE `status` = 1)
                                                AND q.content LIKE ? OR q.title LIKE ?
                                                ORDER BY q.time_posted DESC LIMIT $limit OFFSET $start;";
                                    $stmt = $this->executeQuery($sql, [
                                        '%' . $_GET['searchTxt'] . '%',
                                        '%' . $_GET['searchTxt'] . '%'
                                    ]);
                                    return $stmt->fetchAll();
                                }
                            }
                        }

                        if (!isset($_GET['searchTxt']) || $_GET['searchTxt'] == '') {
                            // User didn't enter any search text for tags or keywords.
                            if (!isset($_GET['searchTxt']) || $_GET['searchTxt'] == '') {
                                $sql = "SELECT q.*, u.username, u.user_id FROM question q
                                            INNER JOIN user u ON
                                            q.user_id = u.user_id
                                            ORDER BY time_posted DESC LIMIT $limit OFFSET $start;";
                                $stmt = $this->executeQuery($sql);
                                return $stmt->fetchAll();
                            }

                            // User search all questions that has no answers.
                            if (isset($_GET['noAns'])) {
                                $sql = "SELECT q.*, u.username, u.user_id FROM question q
                                            INNER JOIN user u ON
                                            q.user_id = u.user_id
                                            WHERE q.question_id NOT IN (SELECT question_id FROM answer)
                                            ORDER BY q.time_posted DESC LIMIT $limit OFFSET $start;";
                                $stmt = $this->executeQuery($sql);
                                return $stmt->fetchAll();
                            }

                            // User search all questions that has no accepted answers or no answer and accepted answer.
                            if (isset($_GET['noAcceptedAns']) || isset($_GET['noAns'], $_GET['noAcceptedAns'])) {
                                $sql = "SELECT q.*, u.username, u.user_id FROM question q
                                            INNER JOIN user u ON
                                            q.user_id = u.user_id
                                            WHERE q.question_id NOT IN (SELECT question_id FROM answer WHERE `status` = 1)
                                            ORDER BY q.time_posted DESC LIMIT $limit OFFSET $start;";
                                $stmt = $this->executeQuery($sql);
                                return $stmt->fetchAll();
                            }
                        }

                        /* ========================================= Most Upvoted ========================================= */
                        if ($_GET['sort'] == 'mostUpvote') {

                            // User entered search text for tags or keywords.
                            if (isset($_GET['searchTxt']) && $_GET['searchTxt'] != '') {

                                // User searched question based on tags.
                                if ($_GET['search'] == 'tag') {
                                    $sql = "SELECT q.*, u.username, u.user_id FROM question q
                                                INNER JOIN user u ON q.user_id = u.user_id
                                                WHERE q.tag = ?
                                                ORDER BY `point` DESC 
                                                LIMIT $limit OFFSET $start;";
                                    $stmt = $this->executeQuery($sql, [$_GET['searchTxt']]);
                                    $filterResults = $stmt->fetchAll();

                                    // User searched question that has no answer based on tags.
                                    if (isset($_GET['noAns'])) {
                                        $sql = "SELECT q.*, u.username, u.user_id FROM question q
                                                    INNER JOIN user u ON
                                                    q.user_id = u.user_id
                                                    WHERE q.question_id NOT IN (SELECT question_id FROM answer)
                                                    AND q.tag = ?
                                                    ORDER BY `point` DESC LIMIT $limit OFFSET $start;";
                                        $stmt = $this->executeQuery($sql, [$_GET['searchTxt']]);
                                        $filterResults = $stmt->fetchAll();
                                    }
                                }

                                // User searched question based on keywords.
                                if ($_GET['search'] == 'keyword') {
                                    $sql = "SELECT q.*, u.username, u.user_id FROM question q
                                                INNER JOIN user u ON q.user_id = u.user_id
                                                WHERE q.content LIKE ? OR q.title LIKE ?
                                                ORDER BY `point` DESC 
                                                LIMIT $limit OFFSET $start;";
                                    $stmt = $this->executeQuery($sql, [
                                        '%' . $_GET['searchTxt'] . '%',
                                        '%' . $_GET['searchTxt'] . '%'
                                    ]);
                                    $filterResults = $stmt->fetchAll();

                                    // User searched question that has no answer based on keywords.
                                    if (isset($_GET['noAns'])) {
                                        $sql = "SELECT q.*, u.username, u.user_id FROM question q
                                                    INNER JOIN user u ON
                                                    q.user_id = u.user_id
                                                    WHERE q.question_id NOT IN (SELECT question_id FROM answer)
                                                    AND q.content LIKE ? OR q.title LIKE ?
                                                    ORDER BY q.`point` DESC LIMIT $limit OFFSET $start;";
                                        $stmt = $this->executeQuery($sql, [
                                            '%' . $_GET['searchTxt'] . '%',
                                            '%' . $_GET['searchTxt'] . '%'
                                        ]);
                                        $filterResults = $stmt->fetchAll();
                                    }
                                }
                            }

                            // User didn't enter any search text for tags or keywords.
                            if (!isset($_GET['searchTxt']) || $_GET['searchTxt'] == '') {

                                // User search all questions that has no answers.
                                if (isset($_GET['noAns'])) {
                                    $sql = "SELECT q.*, u.username, u.user_id FROM question q
                                                INNER JOIN user u ON
                                                q.user_id = u.user_id
                                                WHERE q.question_id NOT IN (SELECT question_id FROM answer)
                                                ORDER BY q.`point` DESC LIMIT $limit OFFSET $start;";
                                    $stmt = $this->executeQuery($sql);
                                    $filterResults = $stmt->fetchAll();
                                }


                                if (!isset($_GET['searchTxt']) || $_GET['searchTxt'] == '') {
                                    $sql = "SELECT q.*, u.username, u.user_id FROM question q
                                                INNER JOIN user u ON
                                                q.user_id = u.user_id
                                                ORDER BY `point` DESC LIMIT $limit OFFSET $start;";
                                    $stmt = $this->executeQuery($sql);
                                    $filterResults = $stmt->fetchAll();
                                }
                            }
                        }
                    }

                    return $filterResults;
                }
            } catch (PDOException $e) {
                die('Error: ' . $e->getMessage());
            }
        }

        // Default query for selecting all questions based on limit and offset value.
        try {
            if (isset($limit, $start)) {
                $sql = "SELECT q.*, u.username, u.user_id FROM question q
                            INNER JOIN user u ON
                            q.user_id = u.user_id
                            ORDER BY time_posted DESC LIMIT $limit OFFSET $start";
                $stmt = $this->executeQuery($sql);
                return $stmt->fetchAll();
            }
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    protected function getQuestionCount($criteria)
    {
        if ($criteria) {
            if ($criteria[0] == 'U') {
                $sql = "SELECT COUNT(question_id) FROM question WHERE `user_id` = ?";
                $stmt = $this->executeQuery($sql, [$criteria]);
                $result = $stmt->fetch();
                return $result['COUNT(question_id)'];
            }
        }

        $sql = "SELECT COUNT(question_id) FROM question;";
        $stmt = $this->executeQuery($sql);
        return $stmt->fetch()['COUNT(question_id)'];
    }

    protected function getHotQuestion()
    {
        $sql = "SELECT * FROM `question` ORDER BY  `point` DESC LIMIT 5";
        $stmt = $this->executeQuery($sql);
        return $stmt->fetchAll();
    }

    protected function timestamp($datetime)
    {
        date_default_timezone_set("Asia/Singapore"); // Setting timezone (From E Heng: For some reason, my php does not follow my computer's time, so I set a timezone for it to work)
        $datetime_now = new \DateTime; // Get current datetime in datetime format
        $previous_datetime = new \DateTime($datetime); // Convert $datetime(which is extracted from MySQL database, to a datetime format)
        $diff = $datetime_now->diff($previous_datetime); // Get difference between the current datetime and the previous datetime

        $diff->w = floor($diff->d / 7); // To get the amount of weeks, floor the days from $diff by 7. Floor() works like round off.
        $diff->d -= $diff->w * 7;

        $string = array( //
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );

        // Setting up the sentence to display (Example: 2 weeks 2 days 2 minutes 3 seconds)
        // $k is key value. For example, using the array above, $k = y,m,w,...
        // $v is the value within the key value. For example, the $v of y in the array above equals to year.
        foreach ($string as $k => &$v) {
            if ($diff->$k) { // E Heng: Let me know if u dont understand this part, I will try my best to explain
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        // Slice the string to return 1 element starting from the 0th index (Example: If the sentence formed in the array was 2 days 2 minutes 3 seconds, it will just return 2 days)
        $string = array_slice($string, 0, 1);
        // Join the array elements with 'ago', If no array elements to be imploded, return the string 'just now'.
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    protected function loadData($limit, $start)
    {
        try {
            $sql = "SELECT q.*, u.username, u.user_id FROM question q
                    INNER JOIN user u ON
                    q.user_id = u.user_id
                    ORDER BY time_posted DESC
                    LIMIT $limit OFFSET $start;";

            $stmt = $this->executeQuery($sql);
            $questionInfos = $stmt->fetchAll();

            foreach ($questionInfos as $question) {
                include '../view/layout/question.php';
            }
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    /* ######### DELETE ######### */
    protected function deleteQuestion($questionId)
    {
        $sql = "DELETE FROM question WHERE `question_id` = ?;";
        $this->executeQuery($sql, [$questionId]);
    }
}
