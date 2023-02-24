<div class="top-nav d-flex justify-content-between align-items-center mt-3">
    <div class="nav-btn d-flex justify-content-center align-items-center">
        <i class='bx bx-menu fs-3 me-2' onclick="navBar()"></i>
        <p>Welcome Admin!</p>
    </div>
    <div class="profile d-flex align-items-center justify-content-center">
        <p class="mx-3"><?php if(isset($_SESSION['adminName'])){
            echo ucwords($_SESSION['adminName']);
        }?></p>
        <div class="dropdown">
            <i class='bx bx-cog me-2 dropdown-toggle' data-bs-toggle="dropdown" aria-expanded="false"></i>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item small-font" href="deletedAdminAccount.php?">Archive</a></li>
                <li><a class="dropdown-item small-font" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>