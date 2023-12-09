<?php include_once "components/head.php"; ?>

<body>
    <?php include_once "components/header.php" ?>
    <main>
        <?php
        if (isset($user) && $user->getAccountType() == "teacher") { ?>

            <div class="container" style="margin-top: 50px;">
                <div class="form-container border border-secondary rounded p-4">
                    <form id="addCourse" action="" method="POST">
                        <div class="row mx-1">
                            <label for="recipient-name" class="col-form-label">Course name:</label>
                            <input type="text" class="form-control" name="name" id="name_input" required>
                        </div>
                        <div class="row mx-1">
                            <label for="recipient-name" class="col-form-label">Requirements:</label>
                            <input type="text" class="form-control" name="requirements" id="requirements_input" required>
                        </div>
                        <div class="row mx-1 mb-5">
                            <label for="recipient-name" class="col-form-label">Description:</label> <br>
                            <textarea name="description" id="description_input" placeholder="Description" required></textarea>
                        </div>
                        <input type="Submit" name="submit" value="Add course" class="btn btn-primary">
                    </form>
                </div>
            </div>
        <?php } else {
            echo "You must be a teacher to create a course :)!";
        } ?>
    </main>
    <?php include_once "components/footer.php" ?>
</body>