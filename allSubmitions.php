<?php include_once "components/head.php" ?>

<body>
    <?php include_once "components/header.php" ?>
    <main>
        <?php
        if ($user != null) {
            //If there is a logged in user
            if ($user->hasJoinedCourse($dbHandler, $_GET["course_id"])) {  //If the user is member of the course ?>

            <?php } else {
                echo "Join the course 1st :)";
            }
        } else {
            echo "Log in 1st :)";
        } ?>
    </main>
    <?php include_once "components/footer.php" ?>
</body>