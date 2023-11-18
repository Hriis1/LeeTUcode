<?php
include_once "include/courseTask.php";
include_once "components/head.php";
?>

<body>
    <?php include_once "components/header.php" ?>
    <main>

        <div class="container mt-5">
            <div class="task-info bg-light border border-secondary rounded ps-3 pt-2">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>
                            <?php echo $_GET["id"]; ?>.CourseName
                        </h2>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <h4>Course owner:</h4>
                        <p>owner</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <h4>Requirements:</h4>
                        <p>Please, provide file with a function deffinition that completes the given task with name and
                            parameters as specified below!</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <h4>Description:</h4>
                        <p>Please, provide file with a function deffinition that completes the given task with name and
                            parameters as specified below!</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <h4>Tasks:</h4>
                        <div class="courses-container" id="coursesContainer">
                            <!-- Placeholder data, replace with your actual courses -->
                            <div class="course-card">
                                <h3>Two Sum</h3>
                            </div>
                            <div class="course-card">
                                <h3>Palindrome Number</h3>
                            </div>
                            <div class="course-card">
                                <h3>Longest Common Prefix</h3>
                            </div>
                            <div class="course-card">
                                <h3>3Sum Closest</h3>
                            </div>
                            <div class="course-card">
                                <h3>Remove Duplicates from Sorted Array</h3>
                            </div>
                            <div class="course-card">
                                <h3>Search Insert Position</h3>
                            </div>
                            <div class="course-card">
                                <h3>Valid Sudoku</h3>
                            </div>
                            <!-- Add more courses as needed -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <?php include_once "components/footer.php" ?>
</body>