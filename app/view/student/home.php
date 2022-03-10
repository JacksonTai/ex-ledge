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
    <link rel="stylesheet" href="<?php echo $path; ?>public/css/layout/question-panel.css">
</head>

<body>

    <?php include '../layout/header.php'; ?>

    <div class="main-sidebar-wrapper">

        <?php include '../layout/sidebar.php' ?>
        <main class="home--main main-content">
            <div class="title-ctnr">
                <h2 class="home__title main-title">Question Asked: </h2>
                <div class="button-header">
                    <button class="button-askQuestion">Ask Question</button>
                    <button class="button-filter">Filter</button>
                </div>
            </div>

            <?php include '../layout/question-panel.php'; ?>
            <?php include '../layout/question-panel.php'; ?>
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