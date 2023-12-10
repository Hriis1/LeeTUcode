<?php include_once "components/head.php"; ?>

<body>
    <?php
    include_once "include/dbHandler.php";
    include_once "include/Course.php";
    include_once "components/header.php";

    //The raw course array from db
    $courseArray = $dbHandler->getCourseById($_GET["course_id"]);

    //Course object
    $course = new Course($courseArray["id"], $courseArray["name"], $courseArray["requirements"], $courseArray["description"], $courseArray["creator_id"]);
    ?>
    <main>
        <?php
        if (isset($user) && $course->getCreatorID() == $user->getID()) { ?>

            <div class="container" style="margin-top: 50px;">
                <div class="form-container border border-secondary rounded p-4">
                    
                </div>
            </div>
        <?php } else {
            echo "You must be the course owner to add a task :)!";
        } ?>
    </main>
    <?php include_once "components/footer.php" ?>
    <script>
        $(document).ready(function () {

            var errorContainer = $("#addTaskrror");
            var errorText = "";

            //Get the errors if any
            <?php if (isset($_SESSION["add_task_error"])) { ?>
                errorText = "<?php echo $_SESSION["add_task_error"]; ?>";
                <?php unset($_SESSION["add_task_error"]);
            } ?>

            //Show the errors
            errorContainer.text(errorText);
        });
    </script>
</body>