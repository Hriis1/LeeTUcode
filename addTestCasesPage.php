<?php include_once "components/head.php"; ?>

<body>
    <?php
    include_once "include/dbHandler.php";
    include_once "include/Course.php";
    require_once "include/isInputEmpty.php";
    include_once "components/header.php";

    //Check if course id is set
    if (!isset($_POST["course_id"])) {
        echo "Error: No course id ;/";
        die();
    }
    //The raw course array from db
    $courseArray = $dbHandler->getCourseById($_POST["course_id"]);

    //Course object
    $course = new Course($courseArray["id"], $courseArray["name"], $courseArray["requirements"], $courseArray["description"], $courseArray["creator_id"]);
    ?>
    <main>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($user) && $course->getCreatorID() == $user->getID()) { ?>
            <?php
            $course_id = $_POST["course_id"];
            $difficulty = $_POST["difficulty"];
            $name = $_POST["name"];
            $description = $_POST["description"];
            $func_name = $_POST["func_name"];
            $func_declaration = $_POST["func_declaration"];
            $num_tests = $_POST["num_tests"];

            //ERROR HANDLERS
            $error = "";

            if (utils\isInputEmpty($difficulty, $name, $description, $func_name, $func_declaration, $num_tests)) {
                $error = "Fill in all fields, please!";
            }

            if ($error) //if there were errors
            {
                $_SESSION["add_task_error"] = $error;

                header('Location: addTaskPage.php?course_id=' . $course_id . '&createCourse=fail'); //Redirect the user
                die();
            }
            ?>
            <div class="container" style="margin-top: 50px;">
                <div class="form-container border border-secondary rounded p-4">
                    <form id="addTaskForm" action="include/addTestCasesPage.php" method="POST">
                        <?php for ($i = 0; $i < intval($num_tests); $i++) { ?>
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-4">
                                    <label for="recipient-name" class="col-form-label">
                                        Test case
                                        <?php echo $i; ?>:
                                    </label>
                                    <input type="text" class="form-control" name="test<?php echo $i; ?>"
                                        id="test<?php echo $i; ?>_input" required>
                                </div>
                                <div class="col-2"></div>
                                <div class="col-4">
                                    <label for="recipient-name" class="col-form-label">
                                        Answer
                                        <?php echo $i; ?>:
                                    </label>
                                    <input type="text" class="form-control" name="answer<?php echo $i; ?>"
                                        id="answer<?php echo $i; ?>_input" required>
                                </div>
                                <div class="col-1"></div>
                            </div>
                        <?php } ?>
                        <input type="Submit" name="submit" value="Finish task" class="btn btn-primary mt-5">
                    </form>
                </div>
            </div>
        <?php } else {
            echo "Error: Forbiden way of getting to this page!";
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