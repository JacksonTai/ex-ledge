<!--TODO: ADAPTIVE HOMEPAGE FOR EITHER STUDENT AND ADMIN-->
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../../public/layout/head.php' ?>
    <link rel="stylesheet" href="../../public/css/home.css">
    <title>Ex-Ledge | Homepage</title>
</head>

<body>

    <?php include '../../public/layout/header.php'; ?>

    <div class="ctnr">

    <!--ugly div nesting needed to allow configuration as show in prototype-->



        <div class="post-view">
            <div class="title-ctnr">
                <div class=""><h1>Questions asked:</h1><p>null</p></div>
                <div><button>Filter</button></div>
            </div>
            <hr>

            <div class="post-ctnr">

                <div class="vote-tab">
                    <i class="vote-arrow rotate-up"></i>
                    <div class="">1</div>
                    <i class="vote-arrow rotate-down"></i>
                </div>

                <div class="post-ctnt">
                    <div class="post-title">hgfgf <i>dsasd</i></div>
                    <div class="post-preview">kjhsdfhkjfsdkhjfvsdkjnhfhjsdkhkjdfgkhjdfgshj</div>
                    <div class="post-tags">
                        <span>asdasdasd</span><span>asdassad</span><span>asdsdaasdasd</span><span>adsasdsda</span><span>asdasdasdasd</span>
                    </div>
                    <div class="post-info">posted by sdfkljsjfljlfsdfsdj</div>
                </div>

            </div>




        </div> 

        <div class="sidebar">
            <div class="trending">
                <button>Ask questions</button>
                <div class="trending-tab">
                    <h3>Top Users</h3><hr>
                    <div>ds</div>
                    <div>sdf</div>
                    <div>fdsdf</div>
                    <div>sdfsdf</div>
                    <div>refwe</div>
                </div>
                <div class="trending-tab">
                    <h3>Hot Topics</h3><hr>
                    <div>ds</div>
                    <div>sdf</div>
                    <div>fdsdf</div>
                    <div>sdfsdf</div>
                    <div>refwe</div>
                </div>
            </div>

        </div>



    </div>
    <?php include '../../public/layout/footer.php'; ?>

    <script src="../../public/js/script.js"></script>        

</body>

</html>