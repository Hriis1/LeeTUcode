<?php
include("include/courseTask.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file_contents = "";
    if (isset($_FILES["submition_file"]) && $_FILES["submition_file"]["error"] == 0) {
        $file_name = $_FILES["submition_file"]["name"];
        $file_tmp = $_FILES["submition_file"]["tmp_name"];

        // Check if the file has a .txt extension
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        if ($file_extension == "txt") {
            // Read the contents of the file
            $file_contents = file_get_contents($file_tmp);

            $task = $_SESSION["current_task"];
            echo $task->addSubmition($file_contents);
        }
        else{
            echo "Only txt files can be submited!";
        }

    }
    else {
        echo "File error!";
    }
}
else {
    echo "Invalid way of getting to this page!";
}