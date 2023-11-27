<?php
include_once "include/dbHandler.php";
include_once "include/Course.php";
include_once "components/head.php";

$coursesArr = $dbHandler->getCourses();
?>

<body>
    <style>
        body {
            margin: 0;
        }

        .courses-container {
            display: flex;
            flex-wrap: wrap;
        }

        .course-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            width: 200px;
        }

        .course-card h3 {
            color: #333;
        }

        .search-container {
            margin-bottom: 20px;
        }

        .search-input {
            padding: 10px;
            width: 300px;
            font-size: 14px;
            box-sizing: border-box;
        }
    </style>
    <?php include_once "components/header.php" ?>
    <main>
        <div class="container my-5">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="search-container">
                        <input type="text" class="search-input" id="searchInput" placeholder="Search by course name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 bg-light border border-secondary rounded ps-5 pt-5 pb-5 mx-auto">
                    <div class="courses-container" id="coursesContainer">
                        <?php foreach ($coursesArr as $course) { ?>
                            <a href="course.php?id=<?php echo $course["id"]; ?>" style="text-decoration: none; color: inherit;">
                                <div class="course-card">
                                    <h3>
                                        <?php echo $course["name"]; ?>
                                    </h3>
                                </div>
                            </a>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include_once "components/footer.php" ?>
    <script src="rec/js/filterCourses.js"></script>
</body>