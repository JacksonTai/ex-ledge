<?php
// Redirect user to main page if they haven't sign in.
if (!$_SESSION['userId']) {
     header('Location: ../../../public/index.php');
}
