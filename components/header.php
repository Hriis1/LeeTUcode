<header>
    <div class="logo"><a href=""><img src="rec/img/logo-Placeholder.jpg" alt=""></a></div>
    <div class="heading">
        <?php
        $_SESSION["user_id"] = 1;
        $_SESSION["user_username"] = "zzz";
        if (isset($_SESSION["user_id"])) {
            echo '<ul>
			<li class="user-info">' . $_SESSION["user_username"] . '</li>
            <li>
                <div class="dropdown">
                    <span>Модули</span>
                    <div class="dropdown-content">
                        <div class="dropdown-item-container"><a class="dropdown-a" href="tableClients.php" class="under">Клиенти</a></div>
                        <div class="dropdown-item-container"><a class="dropdown-a" href="tableMachines.php" class="under">Мащини</a></div>
                        <div class="dropdown-item-container"><a class="dropdown-a" href="createOrder.php" class="under">Поръчки</a></div>
                        <div class="dropdown-item-container"><a class="dropdown-a" href="tableSoftActualization.php" class="under">Софтуерни актуализации</a></div>
                        <div class="dropdown-item-container"><a class="dropdown-a" href="tableMaintenance.php" class="under">Сервизиране</a></div>
                        <div class="dropdown-item-container"><a class="dropdown-a" href="tableWarranty.php" class="under">Гаранционни поддръжки</a></div>
                    </div>
                </div>
             </li>
            <li><a href="include/logout.php" class="under">Отписване</a></li>
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