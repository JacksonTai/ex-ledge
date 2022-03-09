<?php
session_start();
require '../../helper/redirector.php';
$path = '../../../';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../../config/head.php' ?>
    <title>Home | Ex-Ledge</title>
    <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/home.css">
</head>

<body>

    <?php include '../layout/header.php'; ?>

    <div class="main-sidebar-wrapper">

        <?php include '../layout/sidebar.php' ?>
        <main class="home--main main-content">
            <div class="title-ctnr">
                <h2 class="home__title main-title">Question Asked: </h2>
                <div class="button"><button class="button-filter">Filter</button></div>
            </div>

            <div class="panel dialog">
                <div class="vote-container">
                    <i class="fa-solid fa-arrow-up fa-lg"></i>
                    <p>95</p>
                    <i class="fa-solid fa-arrow-down fa-lg"></i>
                </div>
                <div class="question">
                    <div class="question-headers">
                        <div class="question-caption">
                            <p class="question-title">Is Ex-Ledge the best?</p>
                            <p class="question-age">19 mins ago</p>
                        </div>

                        <div class="button">
                            <button class="button-answer">
                                <p>12 Answers</p>
                            </button>
                        </div>
                    </div>

                    <div class="question-body">
                        <div class="fade"></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo </p>
                    </div>

                    <div class="post-tags">
                        <span>#Maths</span>
                    </div>

                    <div class="question-footer">
                        <div class="question-owner">
                            <img class="profile-picture" src="<?php echo $path; ?>public/img/profile.jpg" alt="Profile Image">
                            <p class="posted-by">Posted by&nbsp</p>
                            <p class="owner">Mike Wazowski</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel dialog">
                <div class="vote-container">
                    <i class="fa-solid fa-arrow-up fa-lg"></i>
                    <p>95</p>
                    <i class="fa-solid fa-arrow-down fa-lg"></i>
                </div>
                <div class="question">
                    <div class="question-headers">
                        <div class="question-caption">
                            <p class="question-title">Is Ex-Ledge the best?</p>
                            <p class="question-age">19 mins ago</p>
                        </div>

                        <div class="button">
                            <button class="button-answer">
                                <p>12 Answers</p>
                            </button>
                        </div>
                    </div>

                    <div class="question-body">
                        <div class="fade"></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo </p>
                    </div>

                    <div class="post-tags">
                        <span>#Maths</span>
                    </div>

                    <div class="question-footer">
                        <div class="question-owner">
                            <img class="profile-picture" src="<?php echo $path; ?>public/img/profile.jpg" alt="Profile Image">
                            <p class="posted-by">Posted by&nbsp</p>
                            <p class="owner">Mike Wazowski</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- SIDEBAR -->
        <aside class="home--sidebar">
            <div class="trending">
                <button>Ask questions</button>
                <div class="trending-tab">
                    <h3>Top Users</h3>
                    <hr>
                    <div>ds</div>
                    <div>sdf</div>
                    <div>fdsdf</div>
                    <div>sdfsdf</div>
                    <div>refwe</div>
                </div>
                <div class="trending-tab">
                    <h3>Hot Topics</h3>
                    <hr>
                    <div>ds</div>
                    <div>sdf</div>
                    <div>fdsdf</div>
                    <div>sdfsdf</div>
                    <div>refwe</div>
                </div>
            </div>
        </aside>

    </div>

    <?php include '../layout/footer.php'; ?>

    <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>