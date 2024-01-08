<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

include_once "components/head.php";
$courses = $dbHandler->getCourses();
for ($i = 0; $i < sizeof($courses); $i++) {
    $courseMemberCount = sizeof($dbHandler->getMembersOfCourse($courses[$i]["id"]));
    $courses[$i]["member_count"] = $courseMemberCount;
}

//comparison function for descending order
function compareByMemberCountDescending($a, $b)
{
    return $b['member_count'] - $a['member_count'];
}

// Sorting the array based on the member_count field in descending order
usort($courses, 'compareByMemberCountDescending');

// Selecting the top 5 courses or all courses if there are fewer than 5
$topCourses = array_slice($courses, 0, 5);
?>

<body>
    <?php include_once "components/header.php" ?>
    <main>
        <div class="container my-5">
            <div class="border border-secondary rounded bg-light pt-2 px-3">
                <div class="row mt-3 ">
                    <div class="col-lg-12 border-bottom border-secondary">
                        <h1 class="main-title">
                            Welcome to LeeTUCode
                        </h1>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <h4>Your new go-to destination for your programming courses</h4>
                        <p>Here you can join or create programming courses that can contain coding exercises with
                            instant results based on your needs.</p>
                        <p>The platform is specifically streamlined to be used by teachers and students.</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <h4>Instant results</h4>
                        <p>You can learn whether your attempt was successful once you submit it.</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12 border-bottom border-secondary">
                        <h4>Designed with education in mind</h4>
                        <p>This page's goal is to make it easier for students and teachers alike to practice and teach programming.</p>
                    </div>
                </div>
                <div class="row mt-3 ">
                    <div class="col-lg-12">
                        <h2 class="main-title">
                            Most popular courses
                        </h2>
                    </div>
                </div>
                <!-- to be fetched -->
                <div class="row my-3">
                    <div class="col-lg-12">
                        <ol class="list-group list-group-numbered">
                            <?php for ($i = 0; $i < sizeof($topCourses); $i++) { ?>
                                <li class="list-group-item">
                                    <a href="course.php?id=<?php echo $topCourses[$i]["id"] ?>" class="custom-link">
                                        <?php echo $topCourses[$i]["name"] ?> -
                                        <?php echo $topCourses[$i]["member_count"] ?> users
                                    </a>
                                </li>

                            <?php } ?>
                        </ol>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-3">
                        <a href="courses.php" class="btn btn-primary active" role="button" aria-pressed="true">
                            View all
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include_once "components/footer.php" ?>
</body>