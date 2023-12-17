<!-- <li><a href="course.php?id=1" class="under">CourseTest</a></li>
<li><a href="task.php?id=1" class="under">TaskTest</a></li>
<li>
    <div class="dropdown">
        <a class="under" href="">Dropdown</a>
        <div class="dropdown-content">
            <div class="dropdown-item-container"><a class="dropdown-a" href="" class="under">item1</a></div>
            <div class="dropdown-item-container"><a class="dropdown-a" href="" class="under">item2</a></div>
            <div class="dropdown-item-container"><a class="dropdown-a" href="" class="under">item3</a></div>
            <div class="dropdown-item-container"><a class="dropdown-a" href="" class="under">item4</a></div>
            <div class="dropdown-item-container"><a class="dropdown-a" href="" class="under">item5</a></div>
            <div class="dropdown-item-container"><a class="dropdown-a" href="" class="under">item6</a></div>
        </div>
    </div>
</li>
-->
<?php
include_once "include/User.php";
$user = null;
?>
<header>
    <div class="logo"><a href="index.php"><img src="rec/img/TUlogo.png" alt=""></a></div>
    <div class="heading">
        <?php
        if (isset($_SESSION["user_id"])) {
            //Construct the user
            $userArray = $dbHandler->getUserById($_SESSION["user_id"]);
            $user = new User($userArray['id'], $userArray['username'], $userArray['email'], $userArray['pass'], $userArray['account_type']);
            //tasks the user has yet to solve
            $dueTasks=[];
            foreach ($dbHandler->getCoursesJoinedByUser($user->getID()) as $curCourse)
            {
                $tasks=$dbHandler->getCourseTasksByCourseId($curCourse["id"]);
                foreach ($tasks as $curTask)
                {
                    //checks if the user has solved the task he hasn't created
                    if (!in_array($curTask["course_id"], array_column($dbHandler->getCoursesByCreatorId($user->getID()), "id"))&&!$user->hasSolvedTask($dbHandler, $curTask["id"])) array_push($dueTasks, $curTask);
                }
            }
            //Show the relevant buttons
            echo '<ul>
			<li><a href="profile.php?id=' . $user->getID() . '" class="under">' . $user->getUsername() . '</a>'.(count($dueTasks)>0?'<a href="profile.php?id=' . $user->getID() . '#due-tasks" class="" id="due-tasks-count">'.count($dueTasks).'</a>':"").'</li>
            <li><a href="courses.php" class="under">Courses</a></li>
            <li><a href="include/logout.php" class="under">Log out</a></li>
		    </ul>';
        } else {
            echo '<ul>
			<li><a href="signupForm.php" class="under">Sign up</a></li>
			<li><a href="loginForm.php" class="under">Sign in</a></li>
		    </ul>';
        }
        ?>
    </div>
</header>