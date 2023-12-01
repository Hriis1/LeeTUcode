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
                    <div class="col-lg-12">
                        <h2>
                            <?php echo $course->getName(); ?>
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
                                        <h3>
                                            <?php echo $task["name"]; ?>
                                        </h3>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-2">
                        <a href="joinCourse.php?course_id=<?php echo $_GET["id"]; ?>"
                            class="btn btn-success btn-lg active joinBtn" role="button" aria-pressed="true">Join
                            course</a>
                    </div>
                    <div class="col-8"></div>
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
        //If there is a logged in user
        <?php if ($user != null) { ?>
            //If the user has already joined the course
            <?php if ($user->hasJoinedCourse($dbHandler, $_GET["id"])) { ?>
                console.log("user already joined the course");
            <?php } else { ?>
                console.log("user has not joined the course");
            <?php } ?>
        <?php } else { ?>
            console.log("No user loged in");
        <?php } ?>
    </script>
</body>