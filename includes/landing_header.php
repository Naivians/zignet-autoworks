<?php session_start() ?>

<header class="header">
    <div class="wrapper">
        <nav class="nav">
            <div id="logo">
                <img src="img/ZIGNET.png" alt="">
            </div>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="about_us.php">About Us</a>
                </li>
                <li>
                    <a href="services.php">Services</a>
                </li>
                <li>
                    <a href="contact_us.php">Contact Us</a>
                </li>
                <?php
                if (!isset($_SESSION['user_role'])) {
                ?>
                    <li>
                        <a href="login.php" id="active">Login</a>
                    </li>

                <?php
                } else {
                ?>
                    <div class="mt-3">
                        <a href="user_view.php" class="text-decoration-none text-light d-flex align-items-center justify-content-center "><?= $_SESSION['display_name'] ?> <i class='bx bxs-chevron-right fs-4 text-light'></i></a>
                        
                    </div>
                <?php
                }
                ?>

            </ul>
        </nav>
    </div>
</header>