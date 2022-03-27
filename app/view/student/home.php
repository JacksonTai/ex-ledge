<?php
session_start();
require '../../helper/redirector.php';
include '../../helper/autoloader.php';
$path = '../../../';

$questions = new \Controller\Question();
$answer = new \Controller\Answer();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../../config/head.php' ?>
    <title>Home | Ex-Ledge</title>
    <link rel="stylesheet" href="<?php echo $path; ?>public/css/layout/sidebar.css">
    <link rel="stylesheet" href="<?php echo $path; ?>public/css/layout/question.css">
    <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/home.css">
</head>

<body>

    <?php include '../layout/header.php'; ?>

    <div class="main-sidebar-wrapper">

        <?php include '../layout/sideNavbar.php' ?>

        <main class="home--main main-content">
            <div class="home__header">
                <h2 class="home__header-title main-title">Question Asked:
                    <span class="home__quetion-asked">
                        <?php echo htmlspecialchars($questions->questionCount()); ?>
                    </span>
                </h2>
                <div class="home__header-btn-container">
                    <button class="home__header-btn home__header-btn--filter dialog">Filter</button>
                    <button class="home__header-btn home__header-btn--ask-question dialog">
                        <a class="home__header-link" href="askQuestion.php">Ask Question</a>
                    </button>
                </div>
            </div>
            <div class="home__body">
                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $start = ($page > 1) ? ($page * 10) - 10 : 0;
                $end = empty($questions->read(null, 10, $start)) ? true : false;
                foreach ($questions->read(null, 10, $start) as $question) {
                    include '../layout/question.php';
                }
                ?>
            </div>

            <?php if ($end) : ?>
                <h3 class="home__end-title">Looks like you've reached the end.</h3>
                <img class="home__end-img" src="../../../public/img/homeEmptyState.jpg" alt="">
            <?php endif; ?>

            <nav class="home__main-nav">
                <button class="home__main-nav-btn">
                    <a class="home__main-nav-link dialog <?php echo ($page == 1) ? 'disabled' : '';  ?>" href="
                    <?php
                    $prevPage = $page;
                    $prevPage = ($prevPage > 2) ? '?page=' . $prevPage -= 1 : '';
                    echo $_SERVER['PHP_SELF'] . $prevPage;
                    ?>
                    ">Back
                    </a>
                </button>

                <p class="home__main-nav-page"><?php echo $page; ?></p>
                <button class="home__main-nav-btn <?php echo $end ? 'disabled' : ''; ?>">
                    <a class="home__main-nav-link dialog" href="
                    <?php
                    $nextPage = $page;
                    echo $_SERVER['PHP_SELF'] . '?page=' . $nextPage += 1;
                    ?>
                    ">Next
                    </a>
                </button>
            </nav>
        </main>

        <?php include '../layout/sidebar.php'; ?>

    </div>

    <?php include '../layout/footer.php'; ?>

    <script src="<?php echo $path; ?>public/js/script.js"></script>
    <script src="<?php echo $path; ?>public/js/layout/question.js"></script>
</body>

</html>