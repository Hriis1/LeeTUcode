<header>
    <div class="logo"><a href="index.php"><img src="rec/img/logo-Placeholder.jpg" alt=""></a></div>
    <div class="heading">
        <?php
        if (isset($_SESSION["user_id"])) {
            echo '<ul>
			<li class="user-info">' . $_SESSION["user_username"] . '</li>
            <li><a href="courses.php" class="under">Courses</a></li>
            <li><a href="task.php?id=1" class="under">TaskTest</a></li>
            <li>
                <div class="dropdown">
                    <span>Dropdown</span>
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
            <li><a href="" class="under">Log out</a></li>
		    </ul>';
        } else {
            echo '<ul>
			<li><a href="signupForm.php" class="under">Създаване на акаунт</a></li>
			<li><a href="loginForm.php" class="under">Вписване</a></li>
		    </ul>';
        }
        ?>
    </div>
</header>