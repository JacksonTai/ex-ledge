<?php
session_start();
if (isset($_SESSION['userId'])) {
     echo json_encode($_SESSION['userId']);
}
