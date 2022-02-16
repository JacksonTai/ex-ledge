<!DOCTYPE html>
<html lang="en">
<head>

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
        <h2>Create account</h2>
        <form action="../app/model/signup.php" method="POST">
            <input type="text" id="email" name="email" placeholder="e-mail address"><br>
            <input type="text" id="username" name="username" placeholder="preferred username"><br>

            <!--todo input verification-->
            <input type="password" id="password" name="password" pattern=".{8,}" title="Your entry must exceed 8 characters" placeholder="password"><br>
            <input type="password" id="password" name="password" pattern=".{8,}" title="Your password does not matc" placeholder="confirm password">
            <button>submit</button>
        </form>
    </div>
</div>
<?php include 'layout/footer.php'; ?>

    
</body>
</html>