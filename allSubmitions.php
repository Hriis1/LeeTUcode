<?php include_once "components/head.php" ?>

<body>
    <?php include_once "components/header.php" ?>
    <main>
        <?php
        if ($user != null) {
            //If there is a logged in user
            if ($user->hasJoinedCourse($dbHandler, $_GET["course_id"])) {  //If the user is member of the course
                $submitions = $user->getSubmitionsForTask($dbHandler, $_GET["task_id"]);
                ?>
                <div class="container" style="margin-top: 120px;">
                    <div class="accordion" id="submitionsAccordion">
                        <?php
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
                                        <?php echo $submition["submition_status"]; ?>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
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