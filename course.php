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
            padding: 20px;
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
                                    <div class="task-card d-flex align-items-center">
                                        <h3>
                                            <?php echo $task["name"]; ?>
                                        </h3>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
                echo
                    '<div class="row my-3">
                    <div class="col-12">
                        <a href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Primary link</a>
                    </div>
                </div>';
                ?>

            </div>
        </div>
    </main>
    <?php include_once "components/footer.php" ?>
</body>