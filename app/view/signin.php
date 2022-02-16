<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../../public/layout/head.php' ?>
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/verificationpages.css">

    <title>Ex-Ledge | Sign-in</title>
</head>
<body>
<script src="../../public/js/script.js"></script>


<div class="pagectnr">
<?php include '../../public/layout/header.php'; ?>

    <div class="dialog">
        <h2>Welcome back!</h2>
        <p>Sign into your account</p>
        <form action="../app/model/signin.php" method="POST">
            <input type="text" id="username" name="username" placeholder="username"><br>
            <input type="text" id="password" name="password" pattern=".{8,}" title="Your entry must exceed 8 characters" placeholder="password">
            <button>submit</button>
        </form>
    </div>
</div>
<?php include '../../public/layout/footer.php'; ?>

    
</body>
</html>