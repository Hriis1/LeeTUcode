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
                $error = "Fill in all fields!";
            }

            if ($error) //if there were errors
            {
                $_SESSION["add_task_error"] = $error;

                header('Location: addTaskPage.php?course_id='.$course_id.'&createCourse=fail'); //Redirect the user
                die();
            }
            ?>
            <div class="container" style="margin-top: 50px;">
                <div class="form-container border border-secondary rounded p-4">
                    <form id="addTaskForm" action="include/addTestCasesPage.php" method="POST">
                        TEST CASES BRUV
                        <div class="d-none">
                            <input type="number" class="form-control" name="course_id" id="course_id_input"
                                value="<?php echo $_POST["course_id"]; ?>" required>
                        </div>
                        <div class="row mx-1">
                            <label for="recipient-name" class="col-form-label">Difficulty:</label>
                            <div class="col-2">
                                <select name="difficulty" id="difficulty_input" required>
                                    <option value="easy" selected>Easy</option>
                                    <option value="medium">Medium</option>
                                    <option value="hard">Hard</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mx-1">
                            <label for="recipient-name" class="col-form-label">Task name:</label>
                            <input type="text" class="form-control" name="name" id="name_input" required>
                        </div>
                        <div class="row mx-1">
                            <label for="recipient-name" class="col-form-label">Description:</label> <br>
                            <textarea name="description" id="description_input" placeholder="Description"
                                required></textarea>
                        </div>
                        <div class="row mx-1">
                            <label for="recipient-name" class="col-form-label">Function name:</label>
                            <input type="text" class="form-control" name="func_name" id="func_name_input" required>
                        </div>
                        <div class="row mx-1">
                            <label for="recipient-name" class="col-form-label">Function declaration:</label>
                            <input type="text" class="form-control" name="func_name" id="func_name_input" required>
                        </div>
                        <div class="row mx-1">
                            <label for="recipient-name" class="col-form-label">Number of tests:</label>
                            <input type="number" class="form-control" name="num_tests" id="num_tests_input" step="1" min="0"
                                max="50" required>
                        </div>
                        <div class="row mx-1 mb-5">
                            <label id="add_task_error" class="col-form-label text-danger"></label>
                        </div>
                        <input type="Submit" name="submit" value="Add test cases" class="btn btn-primary">
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