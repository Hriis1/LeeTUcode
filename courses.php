<?php
include_once "include/dbHandler.php";
include_once "include/Course.php";
include_once "components/head.php";

$coursesArr = $dbHandler->getCourses();
//defaults to first page 
$pageNum = isset($_GET["page"])?$_GET["page"]:1;
// items per page
$pageSize = 5;
$searchFilter=isset($_GET["filter"])?$_GET["filter"]:"";
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
            min-height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        .course-card h3 {
            color: #333;
        }
        .course-card>h4 {
            width: 100%;
        }
        .search-container{
            margin-bottom: 20px;
            /* overrides .dropdown margin */
            margin: 2px 0 20px!important;
            z-index: 4;
        }

        .search-input {
            padding: 10px;
            width: 300px;
            font-size: 14px;
            box-sizing: border-box;
        }
        .search-container .dropdown-content{
            width: 100%!important;
        }
        /* button applying the filter */
        .search-container .dropdown-content .dropdown-item-container:last-child{
            margin-top: 10px;
            border-top: 2px solid gray;
        }
        #clear-filter-button{
            position: absolute;
            display: none;
            align-items: center;
            height: 100%;
            right:5%;
        }
        #clear-filter-button a{
            color: gray;
            text-decoration: none;
        }
        
        #invite-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(60, 60, 60, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            overflow: auto;
            z-index: 5;
        }

        #invite-content {
            width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .space-between {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        #popup-close-button {
            position: static;
            cursor: pointer;
        }

        #course-dropdown {
            width: 100%;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
    <?php include_once "components/header.php" ?>
    <main>
        <div class="container my-5">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="search-container dropdown">
                        <input type="text" class="search-input" id="searchInput" placeholder="Search by course name" value="<?=$searchFilter?>">
                        <ul class="dropdown-content list-unstyled">

                        </ul>
                        <div id="clear-filter-button">
                            <a href="courses.php">X</a>
                        </div>
                    </div>
                    <button class="btn btn-success btn-md active" id="popup-button">Add users to course</button>
                </div>
            </div>
            <div id="invite-container">
                <div id="invite-content">
                    <div class="space-between">
                        <h2>Add to course</h2>
                        <div id="popup-close-button">X</div>
                    </div>
                    <div class="space-between">
                        <input type="text" id="username" style="width: 100%;" placeholder="name" required>
                    </div>

                    <div>
                        <select id="course-dropdown">
                            <option value="">Your Courses</option>
                            <?php
                            $coursesCreatorArr = $dbHandler->getCoursesByCreatorId($user->getID());
                            foreach ($coursesCreatorArr as $course) { ?>
                                <option value="<?php echo $course["id"]; ?>">
                                    <?php echo $course["name"]; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="space-between">
                        <p id="responseContainer"></p>
                        <button id="add-user-button" class="btn btn-success btn-md active">Add</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 bg-light border border-secondary rounded ps-5 pt-5 pb-5 mx-auto">
                    <div class="courses-container text-center" id="coursesContainer">
                        <!-- filters courses by value passed in url -->
                        <?php foreach ($coursesArr as $key=>$course) 
                            {
                                if (!str_contains(strtolower($course["name"]), strtolower($searchFilter))) unset($coursesArr[$key]);
                            }
                            $coursesArr=array_values($coursesArr);
                            //invalid pages
                            if ($pageNum<1||$pageNum>ceil(count($coursesArr)/$pageSize)) {?>
                            <h3>Page not found!</h3>
                        <?php } else for ($i=($pageNum-1)*$pageSize; $i<$pageNum*$pageSize&&$i<count($coursesArr); $i++) { ?>
                            <a href="course.php?id=<?php echo $coursesArr[$i]["id"]; ?>" class="no-link-style">
                                <div class="course-card">
                                    <h3>
                                        <?php echo $coursesArr[$i]["name"]; ?>
                                    </h3>
                                    <!-- displays whether user has created or joined this course -->
                                    <?php
                                    if ($user != null) {
                                        if ($user->getID()==$coursesArr[$i]["creator_id"])
                                            echo '<h4 class="text-primary">(Owned)</h4>';
                                        else if ($user->hasJoinedCourse($dbHandler, $coursesArr[$i]["id"])) {
                                            echo '<h4 class="text-success">(Joined)</h4>';
                                        }
                                    }
                                    ?>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <ul class="col-lg-6 pagination">
                    
                </ul>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script> 
    <script src="rec/js/filterCourses.js"></script>
    <script src="rec/js/paginationBar.js"></script>
    <script>
        const pCount=<?=ceil(count($coursesArr)/$pageSize)?>;
        const pNum=<?=$pageNum?>;
        //max # of page links
        //best to be odd so that the current page is centered
        const pageBarLength=9;
        //string to append to url later when building page links containing filter param or nothing if there isnt any already
        const filterParam=<?=$searchFilter==""?'""':'"&filter='.$searchFilter.'"'?>;
        $(document).ready(function() {
            if (filterParam!=="") document.getElementById("clear-filter-button").style.display="inline-flex";
            //builds navigation bar for inner pages
            paginationBar(pCount, pNum, pageBarLength, filterParam);
            
            const courses=jQuery.parseJSON('<?php echo json_encode($coursesArr)?>');
            $('#searchInput').on('input', ()=>dropdownDisplayResults(courses));
            $('#searchInput').one('click', ()=>dropdownDisplayResults(courses));
        })

        document.getElementById('popup-close-button').addEventListener('click', function () {
            document.getElementById('invite-container').style.display = "none";
        });
        document.getElementById('popup-button').addEventListener('click', function () {
            document.getElementById('invite-container').style.display = "flex";
        });

        const addUserButton = document.getElementById('add-user-button');
        addUserButton.addEventListener('click', function () {
            const username = document.getElementById('username').value;
            const courseID = document.getElementById('course-dropdown').value;

            // Send an AJAX request to addUserToCourse.php
            $.ajax({
                url: 'include/addUserToCourse.php',
                method: 'POST',
                data: {
                    username: username,
                    courseID: courseID
                },
                success: function (response) {
                    if (response) {
                        document.getElementById('responseContainer').innerHTML = "user not found";
                    } else {
                        document.getElementById('responseContainer').innerHTML = "user added to course";
                    }
                }
            })
        });
    </script>
    <?php include_once "components/footer.php" ?>
    <script src="rec/js/filterCourses.js"></script>
</body>
