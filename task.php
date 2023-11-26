<?php include_once "include/courseTask.php"; ?>
<?php 
    include_once "components/head.php";
    //Construction
    $functionName = "testFunc";
    $functionDeclaration = "int testFunc(std::vector<int> vec, int x)";
    $testCases = ["{ 1,3,5 }, 2", "{ 1,1,1 }, 2", "{ 2,2,2 }, 5"];
    $testAnswers = [15, 9, 21];
    $difficulty = "easy";
    $task = new CourseTask($functionName, $functionDeclaration, $testCases, $testAnswers, $difficulty);
?>
<body>
    <?php include_once "components/header.php" ?>
    <main>

        <div class="container my-5">
            <div class="task-info bg-light border border-secondary rounded ps-3 pt-2">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>
                            <?php echo $_GET["id"];?>.Title
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
                        <p>Easy</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <h4>Function name:</h4>
                        <p>funcName</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <h4>Function declaration:</h4>
                        <p>funcName(int param1, float param2)</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <h4>Task description:</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad eveniet repellat consequatur
                            natus
                            eius, eum quaerat ut commodi ea consequuntur soluta vel dolor veniam consectetur eaque vero
                            voluptates reiciendis libero.</p>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-4 upload-submition-container bg-light border border-secondary rounded ps-3 pt-2 mt-5
                    upload-form-container d-flex text-center mx-auto">
                    <?php
                    if (isset($_SESSION["user_id"])) {
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
                        echo '<h2>Log in to upload a solution!</h2>';
                    }
                    ?>
                </div>
            </div>

        </div>
    </main>
    <?php include_once "components/footer.php" ?>
</body>