<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'layout/head.php' ?>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/verificationpages.css">

    <title>Ex-Ledge | Sign-up</title>
</head>
<body>
<script src="js/script.js"></script>


<div class="pagectnr">
<?php include 'layout/header.php'; ?>

    <div class="dialog __signupform">
        <form action="../app/model/signup.php">
            <input type="text" id="email" name="email" placeholder="preferred username"><br>
            <input type="text" id="username" name="username" placeholder="preferred username"><br>

            <!--todo input verification-->
            <input type="password" id="password" name="password" placeholder="password"><br>
            <input type="password" id="password" name="password" placeholder="confirm password">
            <button>submit</button>
        </form>
    </div>
</div>
<?php include 'layout/footer.php'; ?>

    
</body>
</html>