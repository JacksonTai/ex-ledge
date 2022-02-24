<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../../public/layout/head.php' ?>
     <link rel="stylesheet" href="../../public/css/verification.css">
     <title>Ex-Ledge | Sign-up</title>
</head>

<body>

     <?php include '../../public/layout/header.php'; ?>

     <main class="signup--main">
          <div class="signup--dialog dialog">
               <h2 class="signup__title">Create account</h2>
               <form action="../app/model/signup.php" method="POST">
                    <input class="signup__input" type="email" id="email" name="email" size="25" placeholder="Email Address"><br>
                    <input class="signup__input" type="text" id="username" name="username" size="25" placeholder="Username"><br>
                    <input class="signup__input" type="password" id="password" name="password" size="25" placeholder="Password"><br>
                    <input class="signup__input" type="password" id="password" name="password" size="25" placeholder="Repeat Password">
                    <button class="signup__btn" type="submit">Sign up</button>
               </form>
               <p class="signup__msg">Already have an account?</p>
               <a class="signin__link" href="signin.php">Sign in</a>
          </div>
     </main>

     <?php include '../../public/layout/footer.php'; ?>

     <script src="../../public/js/script.js"></script>
</body>

</html>