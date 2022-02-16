<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'layout/head.php' ?>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/verificationpages.css">

    <title>Ex-Ledge | Sign-in</title>
</head>
<body>
<script src="js/script.js"></script>


<div class="pagectnr">
<?php include 'layout/header.php'; ?>

    <div class="dialog">
        <form action="../app/model/signin.php" method="POST">
            <input type="text" id="username" name="username" placeholder="username"><br>
            <input type="text" id="password" name="password" placeholder="password">
            <button>submit</button>
        </form>
    </div>
</div>
<?php include 'layout/footer.php'; ?>

    
</body>
</html>