<?php
include_once "components/head.php";

$user = $dbHandler->getUserById($_GET["id"]);
?>

<body>
    <?php include_once "components/header.php" ?>
    <style>
        .task-container {
            display: flex;
            flex-wrap: wrap;
            margin-left: 70px;
            margin-bottom: 30px;
        }

        .task-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            width: 200px;
            min-height: 150px;
        }

        .task-card h3 {
            color: #333;
        }
    </style>
    <main>
        <div class="container my-5">
            <div class="task-info bg-light border border-secondary rounded ps-3 pt-2 pe-3">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1>
                            Profile
                        </h1>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12 d-flex mb-3">
                        <h4>Name:</h4>
                        <p class="ps-3 pt-1">
                            Goshko
                        </p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12 d-flex mb-3">
                        <h4>Eamil:</h4>
                        <p class="ps-3 pt-1">
                            goshko@abv.bg
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <?php include_once "components/footer.php" ?>
</body>