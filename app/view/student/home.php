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
            <div class="home__filter-container dialog hide">
                <h3>Filter Question By: </h3>
                <form class="home__filter-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
                    <div class="home__filter-content-container">
                        <div class="home__filter-form-wrapper">
                            <div class="home__filter-form-item">
                                <input type="radio" name="search" id="keyword" value="keyword">
                                <label for="keyword">Keywords</label>
                            </div>
                            <div class="home__filter-form-item">
                                <input type="radio" name="search" id="tag" value="tag" checked>
                                <label for="tag">Tags</label>
                            </div>
                            <input type="text" name="searchTxt" placeholder="e.g. Keywords or Tags">
                        </div>
                        <div class="home__filter-form-wrapper">
                            <div class="home__filter-form-item">
                                <input type="checkbox" name="noAns" id="noAns" <?php echo isset($_GET['noAns']) ? 'checked' : ''; ?>>
                                <label for="noAns">No Answer</label>
                            </div>
                            <div class="home__filter-form-item">
                                <input type="checkbox" name="noAcceptedAns" id="noAcceptedAns" <?php echo isset($_GET['noAcceptedAns']) ? 'checked' : ''; ?>>
                                <label for="noAcceptedAns">No Accepted Answer</label>
                            </div>
                        </div>
                        <div class="home__filter-form-wrapper">
                            <div class="home__filter-form-item">
                                <input type="radio" name="sort" id="mostUpvote" value="mostUpvote">
                                <label for="mostUpvote">Most Upvoted</label>
                            </div>
                            <div class="home__filter-form-item">
                                <input type="radio" name="sort" id="latest" value="latest" checked>
                                <label for="latest">Latest</label>
                            </div>
                        </div>
                    </div>
                    <div class="home__filter-btn-container">
                        <button class="home__cancel-filter-btn" type="button">Cancel</button>
                        <button class="home__apply-filter-btn" type="submit">Apply</button>
                    </div>
                </form>
            </div>
            <div class="home__body">
                <?php
                // Check for filters URL parameters.
                $filters = isset($_GET['search']) ? '?search=' . $_GET['search'] : '?';
                $filters .= isset($_GET['searchTxt']) && $_GET['searchTxt'] != '' ? '&searchTxt=' . $_GET['searchTxt'] : '';
                $filters .= isset($_GET['noAns']) ? '&noAns=' . $_GET['noAns'] : '';
                $filters .= isset($_GET['noAcceptedAns']) ? '&noAcceptedAns=' . $_GET['noAcceptedAns'] : '';
                $filters .= isset($_GET['sort']) ? '&sort=' . $_GET['sort'] . '&' : '';

                $page = isset($_GET['page']) ? $_GET['page'] : 1;

                $start = ($page > 1) ? ($page * 10) - 10 : 0;

                if (isset($_GET['search'])) {
                    // Check if the user has reach the end of the page.
                    $end = empty($questions->read($_GET, 10, $start)) ? true : false;
                    foreach ($questions->read($_GET, 10, $start) as $question) {
                        include '../layout/question.php';
                        // print_r($question);
                        // echo '<br>';
                        // echo '<br>';
                    }
                }

                if (!isset($_GET['search'])) {
                    // Check if the user has reach the end of the page.
                    $end = empty($questions->read(null, 10, $start)) ? true : false;
                    foreach ($questions->read(null, 10, $start) as $question) {
                        include '../layout/question.php';
                    }
                }
                ?>
            </div>

            <?php if ($end) : ?>
                <h3 class="home__end-title">Looks like you've reached the end.</h3>
                <img class="home__end-img" src="<?php echo $path; ?>public/img/homeEmptyState.jpg" alt="">
            <?php endif; ?>

            <nav class="home__main-nav">
                <button class="home__main-nav-btn <?php echo ($page == 1) ? 'disabled' : '';  ?>">
                    <a class="home__main-nav-link dialog" href="
                    <?php
                    $prevPage = $page;
                    $prevPage = ($prevPage > 2) ? 'page=' . $prevPage -= 1 : '';
                    echo $_SERVER['PHP_SELF'] . $filters . $prevPage;
                    ?>
                    ">Back
                    </a>
                </button>
                <p class="home__main-nav-page"><?php echo $page; ?></p>
                <button class="home__main-nav-btn <?php echo $end ? 'disabled' : ''; ?>">
                    <a class="home__main-nav-link dialog" href="
                    <?php
                    $nextPage = $page;
                    echo $_SERVER['PHP_SELF'] . $filters . 'page=' . $nextPage += 1;
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
    <script src="<?php echo $path; ?>public/js/student/home.js"></script>
</body>

</html>