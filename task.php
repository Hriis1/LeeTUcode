<?php
include_once "include/dbHandler.php";
include_once "include/courseTask.php";
?>
<?php
include_once "components/head.php";

//Construction
if (isset($_GET["id"])&&
    $taskArray = $dbHandler->getCourseTaskById($_GET["id"])) 
{
    $testCases = explode("@@@", $taskArray["test_cases"]);
    $testAnswers = explode("@@@", $taskArray["test_answers"]);
    $task = new CourseTask(
        $taskArray["id"],
        $taskArray["name"],
        $taskArray["description"],
        $taskArray["function_name"],
        $taskArray["function_declaration"],
        $testCases,
        $testAnswers,
        $taskArray["course_id"],
        $taskArray["difficulty"]
    );
}
?>

<body>
    <?php include_once "components/header.php" ?>
    <main>

        <div class="container my-5">
            <div class="task-info bg-light border border-secondary rounded ps-3 pe-3 pt-2">
                <?php if (!isset($task)) echo '<h4>Task not found!</h4>';
                else {?>
                    <div class="row">
                        <div class="col-lg-12 d-flex">
                            <h2>
                                <?php echo $task->getName(); ?>
                            </h2>
                            <h2 class="text-success ps-1">
                                <?php
                                if ($user != null) {
                                    if ($user->hasSolvedTask($dbHandler, $_GET["id"])) {
                                        echo (" (Solved)");
                                    }
                                }
                                ?>
                            </h2>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <h4>How to use:</h4>
                            <p>Please, provide file with a function deffinition that completes the given task with name and
                                parameters as specified below!</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <h4>Difficulty:</h4>
                            <p>
                                <?php echo $task->getDifficulty() ?>
                            </p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <h4>Function name:</h4>
                            <p>
                                <?php echo $task->getFunnctionName() ?>
                            </p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <h4>Function declaration:</h4>
                            <p>
                                <?php echo $task->getFunctionDeclaration() ?>
                            </p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <h4>Task description:</h4>
                            <p>
                                <?php echo $task->getDescription() ?>
                            </p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-2">
                            <a href="course.php?id=<?php echo $task->getCourseId(); ?>"
                                class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Course</a>
                        </div>
                        <div class="col-8"></div>
                        <div class="col-2 d-flex justify-content-end">
                            <a href="allSubmitions.php?task_id=<?php echo $task->getId(); ?>&course_id=<?php echo $task->getCourseId(); ?>"
                                class="btn btn-primary btn-lg submitionsBtn" role="button"
                                aria-pressed="true">Submitions</a>
                        </div>
                    </div>  
            </div>


            <div class="row">
                <div class="col-4 upload-submition-container bg-light border border-secondary rounded ps-3 pt-2 mt-5 mb-5
                    upload-form-container d-flex text-center mx-auto">
                    <?php
                    if (isset($_SESSION["user_id"])) {
                        if ($user->hasJoinedCourse($dbHandler, $task->getCourseId())) {
                            $serializedTask = base64_encode(serialize($task));
                            echo '<form class="form-upload mx-auto" action="include/buildExecutable.php" method="post" enctype="multipart/form-data">
                                        <h2 class="form-upload-heading">Upload solution</h2>
                                        <input type="hidden" name="serializedTask" value="' . $serializedTask . '">
                                        <input type="file" class="form-control" name="submition_file" accept=".txt" required>
                                        <div class="centered mt-3">
                                            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Upload</button>
                                        </div>
                                    </form>';
                        } else {
                            echo "<h2>Join the course to upload a solution!</h2>";
                        }
                    } else {
                        echo '<h2>Log in to upload a solution!</h2>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php }?>
    </main>
    <?php include_once "components/footer.php" ?>
    <script>
        $submitionsBtn = $(".submitionsBtn");
        //If there is a logged in user
        <?php if ($user != null) { ?>
            <?php if ($user->hasJoinedCourse($dbHandler, $task->getCourseId())) { ?>
                //If the user has already joined the course

                //Enable the solutions btn
                $(".submitionsBtn").addClass("active");
                $(".submitionsBtn").removeClass("disabled");
            <?php } else { ?>
                //If the user has not yet joined the course

                //Disable the solutions btn
                $(".submitionsBtn").removeClass("active");
                $(".submitionsBtn").addClass("disabled");
            <?php } ?>
        <?php } else { ?>
            //Disable the solutions btn
            $(".submitionsBtn").removeClass("active");
            $(".submitionsBtn").addClass("disabled");
        <?php } ?>
    </script>
</body>