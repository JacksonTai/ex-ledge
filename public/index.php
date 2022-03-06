<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
     <?php include '../app/config/head.php' ?>
     <link rel="stylesheet" href="css/style.css">
     <title>Ex-Ledge | Forum - Malaysia</title>
</head>

<body>

     <?php include '../app/view/layout/header.php'; ?>

     <main>
          <section class="section--home">
               <img class="section--home__img" src="img/home.jpg" alt="Illustration of collaboration among peers">
               <div class="section--home__container">
                    <h2 class="section--home__title section__title">
                         Study with your peers
                         <span class="highlighted-title">better and faster.</span>
                    </h2>
                    <p class="section--home__content">
                         Ex-Ledge is a forum-based educational system that aids Malaysia high
                         school students in their studies.
                    </p>
                    <button class="section--home-cta-btn">
                         <a class="section--home-cta-link" href="../app/view/verification/signup.php">Get started</a>
                    </button>
               </div>
          </section>
          <section class="section--features">
               <h2 class="section--features__title section__title">
                    Our
                    <span class="highlighted-title">Features</span>
               </h2>
               <div class="section--features__card-container">
                    <div class="section--features__card dialog">
                         <img class="section--features__card-icon" src="img/q&a.jpg" alt=" Q&A Icon">
                         <h3 class="section--features__card-title">Clear your doubts</h3>
                         <p class="section--features__card-content">
                              Having doubts in your topics? Start leveraging Ex-Ledge,
                              where all Malaysia highschool students can see your questions
                              and answers.
                         </p>
                    </div>
                    <div class="section--features__card dialog">
                         <img class="section--features__card-icon" src="img/chat.jpg" alt=" Chat Icon">
                         <h3 class="section--features__card-title">Chat among peers</h3>
                         <p class="section--features__card-content">
                              Still having questions but afraid to ask everyone? Fret not!
                              Start a private conversation with your friends via our chatting
                              system.
                         </p>
                    </div>
                    <div class="section--features__card dialog">
                         <img class="section--features__card-icon" src="img/podium.jpg" alt=" Podium IconF">
                         <h3 class="section--features__card-title">Gain reputation</h3>
                         <p class="section--features__card-content">
                              Wondering how much the community trusts you? Start gaining your
                              reputation by posting good questions and useful answers.
                         </p>
                    </div>
               </div>
          </section>
     </main>

     <?php include '../app/view/layout/footer.php'; ?>
     <script src="js/script.js"></script>
</body>

</html>