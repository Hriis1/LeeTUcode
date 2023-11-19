<?php
include_once "utils.php";

class dbHandler
{
    private $mysqli;
    public function __construct()
    {
        try {
            $host = "localhost";
            $dbname = "leetucode";
            $dbusername = "root";
            $dbpassword = "";

            $this->mysqli = new mysqli($host, $dbusername, $dbpassword, $dbname);
            if ($this->mysqli->connect_errno) {
                throw new Exception("Failed to connect to MySQL: " . $this->mysqli->connect_error);
            }
            mysqli_query($this->mysqli, "SET NAMES 'UTF8'");

        } catch (mysqli_sql_exception $e) {
            die("MySQL error: " . $e->getMessage());
        } catch (Exception $e) {
            die("General error: " . $e->getMessage());
        }

    }

    //=====================================================User=============================================
    public function createUser($username, $email, $pass, $accountType)
    {
        $hashedPassword = hashPassword($pass); //hash the password

        $myQuery = $this->mysqli->prepare("INSERT INTO users (username, email, pass, account_type) VALUES (?,?,?,?);"); //Prepare the sql query
        $myQuery->bind_param("ssss", $username, $email, $hashedPassword, $accountType); //bind the params in place of the '?'
        $myQuery->execute(); //Execute the statement
        $myQuery->close(); //Free/close the statement
    }

    public function getUserByCredentials($user_password, $user_name, $email)
    {
        $myQuery = $this->mysqli->prepare("SELECT * FROM users WHERE (username = ? OR email = ?)");
        $myQuery->bind_param("ss", $user_name, $email);
        $myQuery->execute();

        $result = $myQuery->get_result();

        // Fetch the first row as an associative array
        $userArray = $result->fetch_assoc();

        $myQuery->close();

        $hashedPassword = $userArray["pass"]; //get the hashed password from the database

        if (password_verify($user_password, $hashedPassword)) {
            return $userArray;
        } else {
            return "Incorrect password";
        }


    }

    public function getUserById($id)
    {
        $myQuery = $this->mysqli->prepare("SELECT * FROM users WHERE id = ?");
        $myQuery->bind_param("i", $id);
        $myQuery->execute();

        $result = $myQuery->get_result();

        // Fetch the first row as an associative array
        $userArray = $result->fetch_assoc();

        echo $userArray["id"];
        print_r($userArray);
        $myQuery->close();

        return $userArray;
    }
    //===============================================TaskSubmition==========================================
    public function createTaskSubmition($submited_function, $submition_status, $task_id, $user_id)
    {
        $myQuery = $this->mysqli->prepare("INSERT INTO task_submitions (submited_function, submition_status, task_id, user_id) VALUES (?,?,?,?);"); //Prepare the sql query
        $myQuery->bind_param("ssii", $submited_function, $submition_status, $task_id, $user_id); //bind the params in place of the '?'
        $myQuery->execute(); //Execute the statement
        $myQuery->close(); //Free/close the statement   
    }

    public function getTaskSubmitionsOfUserForTask($user_id, $task_id)
    {
        $myQuery = $this->mysqli->prepare("SELECT * FROM task_submitions 
                WHERE user_id = ? AND task_id = ?");
        $myQuery->bind_param("ii", $user_id, $task_id);
        $myQuery->execute();
        $result = $myQuery->get_result();

        $taskSubArray =[];
        while($row = $result->fetch_assoc())
        {
            $taskSubArray[] = $row;
        } 

        print_r($taskSubArray); // Fetch the first row as an associative array 
        $myQuery->close();

        return $taskSubArray;
    }

    public function getTaskSubmitionById($id)
    {
        $myQuery = $this->mysqli->prepare("SELECT * FROM task_submitions 
                WHERE id = ?");
        $myQuery->bind_param("i", $id);
        $myQuery->execute();
        $result = $myQuery->get_result();

        $taskSubArray = $result->fetch_assoc();

        print_r($taskSubArray); // Fetch the first row as an associative array 
        $myQuery->close();

        return $taskSubArray;
    }
    //==============================================CourseTask==============================================
    public function createCourseTask($name, $description, $function_name, $function_declaration, $test_cases, $test_answers, $course_id, $difficulty)
    {
        $myQuery = $this->mysqli->prepare("INSERT INTO course_tasks (name, description, function_name, function_declaration, test_cases, test_answers, course_id, difficulty) VALUES (?,?,?,?,?,?,?,?);"); //Prepare the sql query
        $myQuery->bind_param("ssssssis", $name, $description, $function_name, $function_declaration, $test_cases, $test_answers, $course_id, $difficulty); //bind the params in place of the '?'
        $myQuery->execute(); //Execute the statement
        $myQuery->close(); //Free/close the statement         
    }

    public function getCourseTasksByCourseId($id)
    { //Returns all tasks from course
        $myQuery = $this->mysqli->prepare("SELECT * FROM course_tasks 
                WHERE course_id = ?");
        $myQuery->bind_param("i", $id);
        $myQuery->execute();
        $result = $myQuery->get_result();

        $courseTasksArray = [];

        while($row = $result->fetch_assoc()) // Fetch the result as an associative array 
        {
            $courseTasksArray[] = $row; 
        }

        print_r($courseTasksArray); 
        $myQuery->close();

        return $courseTasksArray;
    }

    public function getCourseTaskByCourseId($name, $id)
    { //Get task from course with specific name
        $myQuery = $this->mysqli->prepare("SELECT * FROM course_tasks 
                WHERE course_id = ? AND name = ?");
        $myQuery->bind_param("is", $id, $name);
        $myQuery->execute();
        $result = $myQuery->get_result();

        $courseTasksArray = $result->fetch_assoc();

        print_r($courseTasksArray); // Fetch the first row as an associative array 
        $myQuery->close();

        return $courseTasksArray;
    }

    public function getCourseTaskById($id)
    {
        $myQuery = $this->mysqli->prepare("SELECT * FROM course_tasks 
                WHERE id = ?");
        $myQuery->bind_param("i", $id);
        $myQuery->execute();
        $result = $myQuery->get_result();

        $courseTasksArray = $result->fetch_assoc();

        print_r($courseTasksArray); // Fetch the first row as an associative array 
        $myQuery->close();

        return $courseTasksArray;
    }
    //=============================================CourseMember=============================================
    public function createCourseMember($course_id, $user_id)
    {
        $myQuery = $this->mysqli->prepare("INSERT INTO course_members (course_id, user_id) VALUES (?,?);");
        //Prepare the sql query
        $myQuery->bind_param("ii", $course_id, $user_id); //bind the params in place of the '?'
        $myQuery->execute(); //Execute the statement
        $myQuery->close(); //Free/close the statement 
    }

    public function getMembersOfCourse($course_id)
    { 
        $myQuery = $this->mysqli->prepare("SELECT * FROM course_members 
                WHERE course_id = ?");
        $myQuery->bind_param("i", $course_id);
        $myQuery->execute();
        $result = $myQuery->get_result();

        $courseMembersArray = [];
        while($row = $result->fetch_assoc())
        {
            $courseMembersArray[] = $this->getUserById($row["user_id"]);
        }

        print_r($courseMembersArray); // Fetch the first row as an associative array 
        $myQuery->close();

        return $courseMembersArray;
    }

    public function getCoursesJoinedByUser($user_id)
    {
        $myQuery = $this->mysqli->prepare("SELECT * FROM course_members 
                WHERE user_id = ?");
        $myQuery->bind_param("i", $user_id);
        $myQuery->execute();
        $result = $myQuery->get_result();

        $joindCoursesArray = [];
        while($row = $result->fetch_assoc())
        {
            $joindCoursesArray[] = $this->getCourseById($row["course_id"]);
        }

        print_r($joindCoursesArray); // Fetch the first row as an associative array 
        $myQuery->close();

        return $joindCoursesArray;
    }

    public function getCourseMemberById($id)
    {
        $myQuery = $this->mysqli->prepare("SELECT * FROM course_members 
                WHERE id = ?");
        $myQuery->bind_param("i", $id);
        $myQuery->execute();
        $result = $myQuery->get_result();

        $courseMembersArray = $result->fetch_assoc();

        print_r($courseMembersArray); // Fetch the first row as an associative array 
        $myQuery->close();

        return $courseMembersArray;
    }
    //==============================================Course==================================================
    public function createCourse($name, $requirements, $description, $creator_id)
    {
        $myQuery = $this->mysqli->prepare("INSERT INTO courses (name, requirements, description, creator_id) VALUES (?,?,?,?);");
        //Prepare the sql query
        $myQuery->bind_param("sssi", $name, $requirements, $description, $creator_id);
        //bind the params in place of the '?'
        $myQuery->execute(); //Execute the statement
        $myQuery->close(); //Free/close the statement 
    }

    public function getCoursesByCreatorId($id)
    {
        $myQuery = $this->mysqli->prepare("SELECT * FROM courses 
                WHERE creator_id = ?");
        $myQuery->bind_param("i", $id);
        $myQuery->execute();
        $result = $myQuery->get_result();

        $courseArray = [];

        while ($row = $result->fetch_assoc()) {
            // Fetch result as an associative array and append to $courseArray
            $courseArray[] = $row;
        }

        print_r($courseArray);

        $myQuery->close();

        return $courseArray;
    }

    public function getCourseFromCreator($id, $name)
    { //Get course from specific creator with specific name 
        $myQuery = $this->mysqli->prepare("SELECT * FROM courses 
                WHERE creator_id = ? AND name = ?");
        $myQuery->bind_param("is", $id, $name);
        $myQuery->execute();
        $result = $myQuery->get_result();

        $courseArray = $result->fetch_assoc();

        print_r($courseArray); // Fetch the first row as an associative array 

        $myQuery->close();

        return $courseArray;
    }

    public function getCourseById($id)
    {
        $myQuery = $this->mysqli->prepare("SELECT * FROM courses 
                WHERE id = ?");
        $myQuery->bind_param("i", $id);
        $myQuery->execute();
        $result = $myQuery->get_result();

        $courseArray = $result->fetch_assoc();

        print_r($courseArray);  // Fetch the first row as an associative array 

        $myQuery->close();

        return $courseArray;
    }

}

// Report all mysqli errors as exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$dbHandler = new dbHandler();
//$dbHandler->createUser("student2", "student2@example.com", "1234", "student");

//==============================================Course==================================================
//$dbHandler->createCourse("Busted course 2","ludak2 :)", "za ludaci2", 1); //Test course creation
//$dbHandler->getCoursesByCreatorId(1); //Test getCoursesByCreatorId
//$dbHandler->getCourseFromCreator(1, "Busted course 2"); //Test getCourseFromCreator
//$dbHandler->getCourseById(1); Test get course by id

//==============================================CourseTask==================================================
//$dbHandler->createCourseTask("busted task3", "napishi busted funkciq", "bustedFunc", "int bustedFunc(int a, int b)","1,2@@@2,5@@@5,5", "3@@@7@@@10", 1, "easy");
//$dbHandler->getCourseTasksByCourseId(1);
//$dbHandler->getCourseTaskFromCourseWithId("mega task", 2);
//$dbHandler->getCourseTaskById(3);

//===============================================TaskSubmition==========================================
//$dbHandler->createTaskSubmition("int bustedFunc(int a, int b) {return a+b;}", "fail", 1, 1);
//$dbHandler->getTaskSubmitionsOfUserForTask(2,1);
//$dbHandler->getTaskSubmitionById(1);

//=============================================CourseMember=============================================
//$dbHandler->createCourseMember(1,3);
//$dbHandler->getMembersOfCourse(1);




