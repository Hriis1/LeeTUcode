<?php
include_once "utils.php";

class dbHandler
{
    private $mysqli;
    public function __construct()
    {
        try {
            $host = "localhost";
            $dbname = "leeTUcode";
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

    public function getUserByCredentials($user_password, $user_name, $email) //Get user by checking for password and username or email
    {
        $myQuery = $this->mysqli->prepare("SELECT * FROM users 
                WHERE (username = ? OR email = ?) AND pass = ?");
        $myQuery->bind_param("sss", $user_password, $user_name, $email);
        $myQuery->execute();
        $user = $myQuery->get_result();
        echo $user; //these need to be tested because I'm not sure what the result returns actually 
        $myQuery->close();

        return $user;
    }
    //===============================================TaskSubmition==========================================
    public function createTaskSubmition($submited_function, $submition_status, $task_id, $user_id)
    {
        $myQuery = $this->mysqli->prepare("INSERT INTO task_submitions (submited_function, submition_status, task_id, user_id) VALUES (?,?,?,?);"); //Prepare the sql query
        $myQuery->bind_param("ssii", $submited_function, $submition_status, $task_id, $user_id); //bind the params in place of the '?'
        $myQuery->execute(); //Execute the statement
        $myQuery->close(); //Free/close the statement   
    }

    public function getTaskSubmition($user_id, $task_id)
    {
        $myQuery = $this->mysqli->prepare("SELECT * FROM task_submitions 
                WHERE user_id = ? AND task_id = ?");
        $myQuery->bind_param("ii", $user_id, $task_id);
        $myQuery->execute();
        $taskSub = $myQuery->get_result();
        echo $taskSub; //these need to be tested because I'm not sure what the result returns actually 
        $myQuery->close();

        return $taskSub;
    }
    //==============================================CourseTask==============================================
    public function createCourseTask($name, $description, $function_name, $function_declaration, $test_cases, $test_answers, $course_id)
    {
        $myQuery = $this->mysqli->prepare("INSERT INTO course_tasks (name, description, function_name, function_declaration, test_cases, test_answers, course_id) VALUES (?,?,?,?,?,?,?);"); //Prepare the sql query
        $myQuery->bind_param("ssssssi", $name, $description, $function_name, $function_declaration, $test_cases, $test_answers, $course_id); //bind the params in place of the '?'
        $myQuery->execute(); //Execute the statement
        $myQuery->close(); //Free/close the statement         
    }

    public function getCourseTasksByCourseId($id)
    {//Returns all tasks from course
        $myQuery = $this->mysqli->prepare("SELECT * FROM course_tasks 
                WHERE course_id = ?");
        $myQuery->bind_param("i", $id);
        $myQuery->execute();
        $courseTasks = $myQuery->get_result();
        echo $courseTasks; //these need to be tested because I'm not sure what the result returns actually 
        $myQuery->close();

        return $courseTasks;
    }

    public function getCourseTask($name, $id)
    {//Get task from course with specific name
        $myQuery = $this->mysqli->prepare("SELECT * FROM task_submitions 
                WHERE course_id = ? AND name = ?");
        $myQuery->bind_param("is", $id, $name);
        $myQuery->execute();
        $courseTask = $myQuery->get_result();
        echo $courseTask; //these need to be tested because I'm not sure what the result returns actually 
        $myQuery->close();

        return $courseTasks;        
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

    public function getCourseMemberByCourse($course_id)
    {//Gets user_id
        $myQuery = $this->mysqli->prepare("SELECT user_id FROM course_members 
                WHERE course_id = ?");
        $myQuery->bind_param("i", $course_id);
        $myQuery->execute();
        $courseMembers = $myQuery->get_result();
        echo $courseMember; //these need to be tested because I'm not sure what the result returns actually 
        $myQuery->close();

        return $courseMember;
    }

    public function getCourseMemberByUser($user_id)
    {
        $myQuery = $this->mysqli->prepare("SELECT course_id FROM course_members 
                WHERE user_id = ?");
        $myQuery->bind_param("i", $user_id);
        $myQuery->execute();
        $courseMembers = $myQuery->get_result();
        echo $courseMember; //these need to be tested because I'm not sure what the result returns actually 
        $myQuery->close();

        return $courseMember;
    }
    //==============================================Course==================================================
    public function createCourse($name, $requirements, $description, $creator_id)
    {
        $myQuery = $this->mysqli->prepare("INSERT INTO courses (course_id, user_id) VALUES (?,?,?,?);"); 
        //Prepare the sql query
        $myQuery->bind_param("sssi", $name, $requirements, $description, $creator_id); 
        //bind the params in place of the '?'
        $myQuery->execute(); //Execute the statement
        $myQuery->close(); //Free/close the statement 
    }

    public function getCourseByCreatorId($id)
    {
        $myQuery = $this->mysqli->prepare("SELECT * FROM courses 
                WHERE creator_id = ?");
        $myQuery->bind_param("i", $id);
        $myQuery->execute();
        $course = $myQuery->get_result();
        echo $course; //these need to be tested because I'm not sure what the result returns actually 
        $myQuery->close();

        return $course;
    }

    public function getCourse($id, $name)
    {//Get course from specific creator with specific name 
        $myQuery = $this->mysqli->prepare("SELECT * FROM courses 
                WHERE creator_id = ? AND name = ?");
        $myQuery->bind_param("is", $id, $name);
        $myQuery->execute();
        $course = $myQuery->get_result();
        echo $course; //these need to be tested because I'm not sure what the result returns actually 
        $myQuery->close();

        return $course;    
    }
    
}

// Report all mysqli errors as exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$dbHandler = new dbHandler();
