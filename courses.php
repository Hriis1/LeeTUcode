<?php include "components/head.php" ?>

<body>
    <style>
        body {
            font-family: Arial, sans-serif;
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
    <?php include "components/header.php" ?>
    <main>
        <div class="container mt-5">
            <div class="row">
                <div class="col-11 mx-auto">
                    <div class="search-container">
                        <input type="text" class="search-input" id="searchInput" placeholder="Search by course name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-11 bg-light border border-secondary rounded ps-5 pt-5 pb-5 mx-auto">
                    <div class="courses-container" id="coursesContainer">
                        <!-- Placeholder data, replace with your actual courses -->
                        <div class="course-card">
                            <h3>Algorithm Design</h3>
                        </div>
                        <div class="course-card">
                            <h3>Data Structures</h3>
                        </div>
                        <div class="course-card">
                            <h3>Web Development</h3>
                        </div>
                        <div class="course-card">
                            <h3>Database Management</h3>
                        </div>
                        <div class="course-card">
                            <h3>Artificial Intelligence</h3>
                        </div>
                        <div class="course-card">
                            <h3>Mobile App Development</h3>
                        </div>
                        <div class="course-card">
                            <h3>Network Security</h3>
                        </div>
                        <!-- Add more courses as needed -->
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include "components/footer.php" ?>
    <script src="rec/js/filterCourses.js"></script>
</body>