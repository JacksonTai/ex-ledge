<?php $path = '../../../' ?>
<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../../config/head.php' ?>
     <link rel="stylesheet" href="<?php echo $path; ?>public/css/verification.css">
     <title>Ex-Ledge | Sign-up</title>
</head>

<body>

     <?php include '../layout/header.php'; ?>

     <main class="signup--main">
          <div class="signup--dialog dialog">
               <h2 class="signup__title">Create account</h2>
               <form class="signup__form" method="POST">
                    <p class="signup__err-msg signup__err-msg--email invalid-input"></p>
                    <input class="signup__input" type="text" name="email" size="25" placeholder="Email Address"><br>
                    <p class="signup__err-msg signup__err-msg--username invalid-input"></p>
                    <ul>
                         <li class="signup__rules signup__rules--username invalid-input">
                              &#8226; Be between 8 to 30 characters long.
                         </li>
                         <li class="signup__rules signup__rules--username invalid-input">
                              &#8226; Be containing alphabet only.
                         </li>
                    </ul>
                    <input class="signup__input" type="text" name="username" size="25" placeholder="Username"><br>
                    <p class="signup__err-msg signup__err-msg--password invalid-input"></p>
                    <ul>
                         <li class="signup__rules signup__rules--password invalid-input">
                              &#8226; Be at least 8 characters long.
                         </li>
                         <li class="signup__rules signup__rules--password invalid-input">
                              &#8226; Have at least 1 uppercase.
                         </li>
                         <li class="signup__rules signup__rules--password invalid-input">
                              &#8226; Have at least 1 lowercase.
                         </li>
                         <li class="signup__rules signup__rules--password invalid-input">
                              &#8226; Have at least 1 number.
                         </li>
                    </ul>
                    <input class="signup__input" type="password" name="password" size="25" placeholder="Password"><br>
                    <p class="signup__err-msg signup__err-msg--password-repeat invalid-input"></p>
                    <input class="signup__input" type="password" name="passwordRepeat" size="25" placeholder="Repeat Password">
                    <button class="signup__btn" type="submit">Sign up</button>
               </form>
               <p class="signup__msg">Already have an account?</p>
               <a class="signin__link" href="signin.php">Sign in</a>
          </div>
     </main>

     <?php include '../layout/footer.php'; ?>

     <script src="<?php echo $path; ?>public/js/script.js"></script>
     <script src="<?php echo $path; ?>public/js/verification/signup.js"></script>
</body>

</html>