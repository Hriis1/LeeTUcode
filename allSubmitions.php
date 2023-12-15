<?php include_once "components/head.php" ?>

<body>
    <?php include_once "components/header.php" ?>
    <main>
        <?php
        if ($user != null) {
            //If there is a logged in user
            if ($user->hasJoinedCourse($dbHandler, $_GET["course_id"])) {  //If the user is member of the course
                if ($dbHandler->getCourseById($_GET["course_id"])["creator_id"]==$user->getID()) {
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
                        if (count($curUserSubmitions)==0) array_push($noSubmitionsUsers, $member);
                    }
                }
                else $submitions = $user->getSubmitionsForTask($dbHandler, $_GET["task_id"]);
                ?>
                <div class="container" style="margin-top: 120px;">
                    <div class="accordion" id="submitionsAccordion">
                        <?php
                        if (count($submitions) == 0) { ?>
                            <div class="mb-3">
                                You haven't submitted any solutions yet!
                            </div>
                            <a class="btn btn-primary" href="task.php?id=<?php echo $_GET["task_id"]?>">
                                Back to task
                            </a>
                        <?php }
                        $idx = 0;
                        foreach ($submitions as $submition) { ?>
                            <div class="accordion-item">
                                <h2>
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse<?php echo ++$idx ?>" aria-expanded="false"
                                        aria-controls="collapse<?php echo $idx ?>">
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
                                        <?php if (isset($members)) { echo nl2br($submition["response"]); ?>
                                        Submitted by:<br>
                                        <?php echo nl2br($members[$submition["user_id"]-1]["username"]); }?>
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