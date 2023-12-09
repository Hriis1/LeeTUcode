<?php include_once "components/head.php"; ?>

<body>
    <?php include_once "components/header.php" ?>
    <main>
        <?php
        if(isset($user) && $user->getAccountType() == "teacher") { ?>

        gj kopele teacher si
        <?php } else {
            echo "You must be a teacher to create a course :)!";
        } ?>
    </main>
    <?php include_once "components/footer.php" ?>
</body>