<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../../public/layout/head.php' ?>
    <link rel="stylesheet" href="../../public/css/verification.css">
    <title>Ex-Ledge | Sign-in</title>
</head>

<body>

    <?php include '../../public/layout/header.php'; ?>

    <main class="signin--main">
        <div class="signin--dialog dialog">
            <h2 class="signin__title">Welcome back!</h2>
            <p class="signin__sub-title">Sign into your account</p>
            <form action="../app/model/signin.php" method="POST">
                <input class="signin__input" type="email" id="email" name="email" size="25" placeholder="Email Address"><br>
                <input class="signin__input" type="password" id="password" name="password" size="25" placeholder="Password"><br>
                <button class="signin__btn" type="submit">Sign in</button>
            </form>
            <p class="signin__msg">Don't have an account yet?</p>
            <a class="signup__link" href="signup.php">Create account</a>
        </div>
    </main>

    <?php include '../../public/layout/footer.php'; ?>

    <script src="../../public/js/script.js"></script>
</body>

</html>