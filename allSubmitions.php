<?php include_once "components/head.php" ?>

<body>
    <?php include_once "components/header.php" ?>
    <main>
        <?php
        if ($user != null) {
            if (!isset($_GET["course_id"])||!isset($_GET["task_id"])) echo "Page not found :(";
            //If there is a logged in user
            else if ($user->hasJoinedCourse($dbHandler, $_GET["course_id"])) {  //If the user is member of the course
                //saves an array of all task submissions grouped by the users who submitted them andd an array of the students who haven't attempted it
                //only if the logged in user is the creator of the course
                if (($creatorID=$dbHandler->getCourseById($_GET["course_id"])["creator_id"])==$user->getID()) {
                    $members=$dbHandler->getMembersOfCourse($_GET["course_id"]);
                    $submitions=[];
                    $noSubmitionsUsers=[];
                    //constructs user object from table data
                    foreach ($members as $member) {
                        $current = new User(
                            $member["id"],
                            $member["username"],
                            $member["email"],
                            $member["pass"],
                            $member["account_type"]
                        );
                        //all submissions of current user
                        $curUserSubmitions=$current->getSubmitionsForTask($dbHandler, $_GET["task_id"]);
                        $submitions=array_merge($submitions, $curUserSubmitions);
                        //adds user to array if he isn't the creator of the course and hasn't submitted anything yet
                        if (count($curUserSubmitions)==0&&$creatorID!=$current->getID()) array_push($noSubmitionsUsers, $member);
                    }
                }
                else $submitions = $user->getSubmitionsForTask($dbHandler, $_GET["task_id"]);
                ?>
                <div class="container" style="margin-top: 120px;">
                    <?php
                    if (count($submitions) == 0) { ?>
                        <div class="mb-3">
                            No solutions have been submitted yet!
                        </div>
                        <a class="mb-3 btn btn-primary" href="task.php?id=<?php echo $_GET["task_id"]?>">
                            Back to task
                        </a>
                    <?php } ?>
                    <div class="accordion" id="submitionsAccordion">
                        <?php 
                        $idx = 0;
                        //displays intended solutions if submitted by creator
                        if ($dbHandler->hasUserSolvedTask($creatorID, $_GET["task_id"]))
                        {
                            $creatorSubmissions=$dbHandler->getTaskSubmitionsOfUserForTask($creatorID, $_GET["task_id"]);
                            $solutions=[];
                            //filters the successful attempts by the creator
                            foreach (array_keys(array_column($creatorSubmissions, "submition_status"), "success") as $key)
                            {
                                array_push($solutions, $creatorSubmissions[$key]);
                            }
                            foreach ($solutions as $solution) {?>
                            <div class="accordion-item">
                                <h2>
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse<?php echo ++$idx ?>" aria-expanded="false"
                                        aria-controls="collapse<?php echo $idx ?>">
                                        <strong class="text-success">
                                            Solution #<?php echo $idx ?>
                                        </strong>
                                    </button>
                                </h2>
                                <div id="collapse<?php echo $idx ?>" class="accordion-collapse collapse"
                                    aria-labelledby="headingOne" data-bs-parent="#submitionsAccordion">
                                    <div class="accordion-body">
                                        <?php echo nl2br($solution["submited_function"]) ?>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        }
                        foreach ($submitions as $submition) { ?>
                            <div class="accordion-item">
                                <h2>
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse<?php echo ++$idx ?>" aria-expanded="false"
                                        aria-controls="collapse<?php echo $idx ?>">
                                        <?php if (isset($members)) 
                                            echo '<strong class="pe-3">'.$members[array_search($submition["user_id"], array_column($members, "id"))]["username"].'</strong>';?>
                                        <?php echo $submition["updated_at"] ?>
                                        <text class="ps-1 response">
                                            (<?php echo $submition["submition_status"]; ?>)
                                        </text>
                                    </button>
                                </h2>
                                <div id="collapse<?php echo $idx ?>" class="accordion-collapse collapse"
                                    aria-labelledby="headingOne" data-bs-parent="#submitionsAccordion">
                                    <div class="accordion-body">
                                        Submited function:<br>
                                        <?php echo nl2br($submition["submited_function"]) ?><br><br>
                                        Response:<br>
                                        <?php  echo nl2br($submition["response"]);?>
                                    </div>
                                </div>
                            </div>
                        <?php } if (isset($noSubmitionsUsers)&&count($noSubmitionsUsers)>0) {?>
                            <!-- displays the list of course members who havent uploaded a solution yet -->
                            <div class="row my-3">
                                <div class="col-lg-12">
                                    <h4>Course members who haven't provided a solution: </h4>
                                    <ul class="list-group">
                                        <?php foreach ($noSubmitionsUsers as $member) {?>
                                            <li class="list-group-item">
                                                <a><!-- could link to user's profile --> 
                                                    <?php echo $member["username"] ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            <?php } else {
                echo "Join the course 1st :)";
            }
        } else {
            echo "Log in 1st :)";
        } ?>
    </main>
    <?php include_once "components/footer.php" ?>
    <script>
        var responseTexts = $(".response");
        responseTexts.each(function()
        {
            var currentElement = $(this);
            if(currentElement.text().trim() == "(success)")
            {
                currentElement.addClass("text-success");
            }
            else
            {
                currentElement.addClass("text-danger");
            }
        });
    </script>
</body>