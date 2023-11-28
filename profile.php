<?php
include_once "components/head.php";

$user = $dbHandler->getUserById($_GET["id"]);

$joinedCourses = $dbHandler->getCoursesJoinedByUser($user["id"]);
?>

<body>
    <?php include_once "components/header.php" ?>
    <style>
        .course-container {
            display: flex;
            flex-wrap: wrap;
            margin-left: 70px;
            margin-bottom: 30px;
        }

        .course-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            width: 200px;
            min-height: 150px;
        }

        .course-card h3 {
            color: #333;
        }
    </style>
    <main class="mb-5">
        <div class="container my-5">
            <div class="course-info bg-light border border-secondary rounded ps-3 pt-2 pe-3">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1>
                            Profile
                        </h1>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12 d-flex mb-3">
                        <h4>Name:</h4>
                        <p class="ps-3 pt-1">
                            <?php echo $user["username"]; ?>
                        </p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12 d-flex mb-3">
                        <h4>Eamil:</h4>
                        <p class="ps-3 pt-1">
                            <?php echo $user["email"]; ?>
                        </p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <h4>Joined courses:</h4>
                        <div class="course-container d-flex text-center" id="coursesContainer">
                            <?php foreach ($joinedCourses as $course) { ?>
                                <a href="course.php?id=<?php echo $course["id"]; ?>" class="no-link-style">
                                    <div class="course-card d-flex align-items-center">
                                        <h3>
                                            <?php echo $course["name"]; ?>
                                        </h3>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php if ($user["account_type"] == "teacher") { ?>
                    <div class="row my-4">
                        <div class="col-12">
                            <a href="#" class="btn btn-primary btn-lg active" role="button"
                                aria-pressed="true">Create a course</a>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </main>
    <?php include_once "components/footer.php" ?>
</body>