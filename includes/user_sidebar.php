<aside class="aside">
    <div class="sidebar">
        <!-- <i class='bx bxs-user-circle'></i> -->
        <div class="username">
            <ul>
                <li class="d-flex align-items-center">
                    <i class='bx bxs-user-circle fs-3 me-2'></i>
                    <a href="user_view.php" class="text-primary"><?= $_SESSION['display_name'] ?></a>
                </li>
            </ul>
        </div>
        <div class="sidebar_actions mt-3">
            <ul>

                <li class="d-flex align-items-center mt-2r">
                    <a href="index.php" class="">
                        <i class='bx bx-home'></i>
                        Home
                    </a>
                </li>

                <li class="d-flex align-items-center mt-2r">
                    <a href="user_view.php" class="">
                        <i class='bx bx-folder-open'></i>
                        Request form
                    </a>
                </li>

                <li class="d-flex align-items-center mt-2r">
                    <a href="requested_form.php" class="">
                        <i class='bx bx-folder-open'></i>
                        Submitted form
                    </a>
                </li>

                <li class="d-flex align-items-center mt-2r">
                    <a href="user_profile.php" class="">
                        <i class='bx bx-user'></i>
                        Profile
                    </a>
                </li>

                <li class="d-flex align-items-center mt-2">
                    <a href="logout.php?user=user">
                        <i class='bx bx-log-out '></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- for mobile navs -->
    <div class="sm-sidebar" id="sm-sidebar">
        <div class="sidebar_actions mt-3">
            <ul>
                <li class="d-flex align-items-center mt-2r">
                    <a href="index.php" class="">
                        <i class='bx bx-home'></i>
                        Home
                    </a>
                </li>

                <li class="d-flex align-items-center mt-2r">
                    <a href="user_view.php" class="">
                        <i class='bx bx-folder-open'></i>
                        Request form
                    </a>
                </li>

                <li class="d-flex align-items-center mt-2r">
                    <a href="requested_form.php" class="">
                        <i class='bx bx-folder-open'></i>
                        Submitted form
                    </a>
                </li>

                <li class="d-flex align-items-center mt-2r">
                    <a href="user_profile.php" class="">
                        <i class='bx bx-user'></i>
                        Profile
                    </a>
                </li>

                <li class="d-flex align-items-center mt-2">
                    <a href="logout.php?user=user">
                        <i class='bx bx-log-out '></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>