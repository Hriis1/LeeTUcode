<?php 
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

include_once "components/head.php" ?>
<body>
    <?php include_once "components/header.php" ?>
    <main>
        <div class="container my-5">
            <div class="border border-secondary rounded bg-light pt-2 px-3">
                <div class="row mt-3 "> 
                    <div class="col-lg-12 border-bottom border-secondary">    
                        <h1 class="main-title">
                            Welcome to LeeTUCode
                        </h1>
                    </div>
                </div>   
                <div class="row mt-3"> 
                    <div class="col-lg-12">   
                        <h4>Your new go-to destination for your prgramming courses</h4>
                        <p>Here you can join or create programming courses that can contain coding exercises with instant results based on your needs.</p>
                        <p>The platform is specifically streamlined to be used by teachers and students.</p>
                    </div>
                </div>
                <div class="row mt-3"> 
                    <div class="col-lg-12">   
                        <h4>Instant results</h4>
                        <p>You can learn whether your attempt was successful once you submit it.</p>
                    </div>
                </div>
                <div class="row mt-3"> 
                    <div class="col-lg-12 border-bottom border-secondary">   
                        <h4>Something else</h4>
                        <p>Additional info</p>
                    </div>
                </div>
                <div class="row mt-3 "> 
                    <div class="col-lg-12">    
                        <h2 class="main-title">
                            Most popular courses
                        </h2>
                    </div>
                </div>   
                <!-- to be fetched -->
                <div class="row my-3"> 
                    <div class="col-lg-12">    
                        <ol class="list-group list-group-numbered">   
                            <li class="list-group-item">Number one - x users</li>
                            <li class="list-group-item">Number two - y users</li>
                            <li class="list-group-item">Number three - z users</li>
                            <li class="list-group-item">Number four - a users</li>
                            <li class="list-group-item">Number five -  users</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include_once "components/footer.php" ?>
</body>