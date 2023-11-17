<?php include "components/head.php" ?>

<body>
    <?php include "components/header.php" ?>
    <main>

        <div class="container mt-5">
            <div class="task-info bg-light border border-secondary rounded ps-3 pt-2">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>
                            <?php echo $_GET["id"]; ?>.Title
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

        </div>
    </main>
    <?php include "components/footer.php" ?>
</body>