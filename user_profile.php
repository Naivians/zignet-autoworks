<?php
session_start();

// if (!isset($_SESSION['user_role'])) {
//     header("Location:login.php");
// } 

include "functions.php";

$res = validateCredential("user", $_SESSION['username']);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "includes/header.php"; ?>
    <title>User | Dashboard</title>
    <link rel="stylesheet" href="css/user.css?<?= time(); ?>">

</head>

<body>
    <main class="main">
        <div class="header">
            <h2 class="text-center mt-2" id="title">User Profile</h2>
            <div class="user_nav_container">
                <div class="user_nav">
                    <h4 class="text-center text-light" id="sm_title"><?= $_SESSION['display_name'] ?></h4>
                    <i class='bx bx-menu fs-1 me-2 text-light ' id="btn" onclick="toggle()"></i>
                </div>
            </div>
        </div>

        <div class="wrapper mt-3">
            <?php
            while ($row = $res->fetch_assoc()) {
            ?>
                <div class="form">
                    <form>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="" class="form-label text-secondary">User ID</label>
                                    <input type="text" name="user_id" id="user_id" class="form-control" value="<?= $row['user_id'] ?>" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label text-secondary">Full Name</label>
                                    <input type="text" name="update_display_name" id="update_display_name" class="form-control" value="<?= $row['display_name'] ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label text-secondary">Username</label>
                                    <input type="text" name="update_username" id="update_username" class="form-control" value="<?= $row['username'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label text-secondary">Password</label>
                                    <input type="password" name="update_password" id="update_password" class="form-control mb-2" value="<?= $row['password'] ?>">
                                    <input type="checkbox" name="" onclick="showPass('update_password')">
                                    <span class="">show password</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label text-secondary">Date Created</label>
                                    <input type="text" name="update_date_added" id="update_date_added" class="form-control" value="<?= $row['date_added'] ?>" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label text-secondary">Date Modified</label>
                                    <input type="text" name="update_password" id="update_password" class="form-control" value="<?= $row['date_modified'] ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label text-secondary">Contact #</label>
                                    <input type="text" name="update_contact" id="update_contact" class="form-control" value="<?= $row['contact'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 mt-3">
                            <button type="button" onclick="update_user()" class="btn btn-outline-success">Update Account</button>
                        </div>
                    </form>
                </div>

            <?php
            }
            ?>
        </div>
    </main>

    <?php
    include "includes/user_sidebar.php";
    include "includes/script.php";
    ?>

    <script>
        function toggle() {
            var responsive_nav = document.querySelector(".sm-sidebar");
            responsive_nav.classList.toggle("move");
        }

        function showPass(id) {
            var x = document.getElementById(id);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function update_user() {
            var user_id = $("#user_id").val();
            var update_display_name = $("#update_display_name").val();
            var update_password = $("#update_password").val();
            var update_contact = $("#update_contact").val();
            var update_contact = $("#update_username").val();

            var inputs = [$("#update_display_name"), $("#update_password"), $("#update_contact"), $("#update_username")];

            // check for empty fields
            for (let i = 0; i < inputs.length; i++) {
                if (inputs[i].val() == "") {
                    inputs[i].css("border", "1px solid red");
                    // console.log(inputs[i]);
                }
            }

            if (update_display_name == "") {
                $("#update_display_name").css("border", "1px solid red");
            } else if (update_password == "") {
                $("#update_password").css("border", "1px solid red");
            } else if (update_contact == "") {
                $("#update_contact").css("border", "1px solid red");
            } else if (update_username == "") {
                $("#update_username").css("border", "1px solid red");
            } else {

                var data = {
                    user_id: $("#user_id").val(),
                    update_display_name: $("#update_display_name").val(),
                    update_username: $("#update_username").val(),
                    update_password: $("#update_password").val(),
                    update_contact: $("#update_contact").val(),
                    update_user_btn: 1,
                }

                $.ajax({
                    url: "updateData.php",
                    method: "POST",
                    data: data,
                    success: (res) => {
                        if (res != "success") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: res,
                            })
                        } else {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Successfully Update',
                                showConfirmButton: false,
                                timer: 1000
                            })

                            setInterval(() => {
                                window.location.reload();
                            }, 1000);
                        }
                    }
                });
            }


        }
    </script>
</body>

</html>