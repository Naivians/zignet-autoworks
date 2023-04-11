<div class="top-nav d-flex justify-content-between align-items-center mt-3">
    <div class="nav-btn d-flex justify-content-center align-items-center">
        <i class='bx bx-menu fs-3 me-2' onclick="navBar()"></i>
        <p>Welcome Admin!</p>
    </div>
    <div class="profile d-flex align-items-center justify-content-center">
        <p class="mx-3"><?php if (isset($_SESSION['adminName'])) {
                            echo ucwords($_SESSION['adminName']);
                        } ?></p>
        <div class="dropdown">
            <i class='bx bx-cog me-2 dropdown-toggle' data-bs-toggle="dropdown" aria-expanded="false"></i>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item small-font" href="deletedAdminAccount.php?">Archive</a></li>
                <li><a class="dropdown-item small-font" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>


<!-- <div class="notif-container">
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center w-100">
        Then put toasts within
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>
</div>

<audio src="notif.mp3" hidden id="notif"></audio>

<button class="btn btn-success" onclick="notify()">toast</button>

<script>
    function notify() {
        var notif = document.getElementById('notif');
        notif.play();
        let myAlert = document.querySelector('.toast');
        let bsAlert = new bootstrap.Toast(myAlert);
        bsAlert.show();
        bsAlert.delay(1000);
    }
</script> -->