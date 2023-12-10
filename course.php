<?php
include_once "include/dbHandler.php";
include_once "include/Course.php";
include_once "include/courseTask.php";
include_once "components/head.php";

//The raw array from db
$courseArray = $dbHandler->getCourseById($_GET["id"]);

//Course object
$course = new Course($courseArray["id"], $courseArray["name"], $courseArray["requirements"], $courseArray["description"], $courseArray["creator_id"]);

//Tasks array from db
$courseTasks = $dbHandler->getCourseTasksByCourseId($course->getID());
?>

<body>
    <style>
        .task-container {
            display: flex;
            flex-wrap: wrap;
            margin-left: 70px;
            margin-bottom: 30px;
        }

        .task-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
            width: 200px;
            min-height: 150px;
        }

        .task-card h3 {
            color: #333;
        }
    </style>
    <?php include_once "components/header.php" ?>
    <main>

        <div class="container my-5">
            <div class="task-info bg-light border border-secondary rounded ps-3 pt-2 pe-3">
                <div class="row">
                    <div class="col-lg-12 d-flex">
                        <h2>
                            <?php echo $course->getName(); ?>
                        </h2>
                        <h2 class="text-success ps-1">
                            <?php
                            if ($user != null) {
                                if ($user->hasJoinedCourse($dbHandler, $_GET["id"])) {
                                    echo (" (Joined)");
                                }
                            }
                            ?>
                        </h2>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <h4>Course owner:</h4>
                        <p>
                            <?php echo $course->getCreatorName($dbHandler); ?>
                        </p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <h4>Requirements:</h4>
                        <p>
                            <?php echo $course->getRequirements(); ?>
                        </p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <h4>Description:</h4>
                        <p>
                            <?php echo $course->getDescription(); ?>
                        </p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <h4>Tasks:</h4>
                        <div class="task-container d-flex text-center" id="coursesContainer">
                            <?php foreach ($courseTasks as $task) { ?>
                                <a href="task.php?id=<?php echo $task["id"]; ?>" class="no-link-style">
                                    <div class="task-card d-flex align-items-center justify-content-center">
                                        <div>
                                            <h3>
                                                <?php echo $task["name"]; ?>
                                            </h3>
                                            <h3 class="text-success ps-1">
                                                <?php
                                                if ($user != null) {
                                                    if ($user->hasSolvedTask($dbHandler, $task["id"])) {
                                                        echo (" (Solved)");
                                                    }
                                                }
                                                ?>
                                            </h3>
                                        </div>

                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-2">
                        <a href="include/joinCourse.php?course_id=<?php echo $_GET["id"]; ?>"
                            class="btn btn-success btn-lg active joinBtn" role="button" aria-pressed="true">Join
                            course</a>

                        <a href="include/leaveCourse.php?course_id=<?php echo $_GET["id"]; ?>"
                            class="btn btn-danger btn-lg disabled d-none leaveBtn" role="button"
                            aria-pressed="true">Leave
                            course</a>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-2">
                        <?php if ($course->getCreatorID() == $user->getID()) { ?>
                            <a href="addTaskSetupPage.php" class="btn btn-success btn-lg active ms-5" role="button"
                                aria-pressed="true">Add task</a>
                        <?php } ?>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-2 d-flex justify-content-end">
                        <a href="courses.php" class="btn btn-primary btn-lg active" role="button"
                            aria-pressed="true">All courses</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include_once "components/footer.php" ?>
    <script>
        $joinCourseBtn = $(".joinBtn");
        $leaveCourseBtn = $(".leaveBtn");
        //If there is a logged in user
        <?php if ($user != null) { ?>
            <?php if ($user->hasJoinedCourse($dbHandler, $_GET["id"])) { ?>
                //If the user has already joined the course

                //Disable and hide the join btn
                $(".joinBtn").addClass("disabled");
                $(".joinBtn").addClass("d-none");

                //Enable the leave btn
                $(".leaveBtn").removeClass("disabled");
                $(".leaveBtn").removeClass("d-none");
            <?php } else { ?>
                //If the user has not yet joined the course
                $(".joinBtn").text("Join course");
            <?php } ?>
        <?php } else { ?>
            //If there isnt a logged in user
            $(".joinBtn").addClass("disabled");
            $(".joinBtn").text("Log in to join");
        <?php } ?>
    </script>
</body>