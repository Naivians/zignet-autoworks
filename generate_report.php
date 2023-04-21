<?php
session_start();
include "includes/config.php";
include "functions.php";



if (isset($_POST['client'])) {

    $column = $conn->escape_string($_POST['column']);
    $column_value = $conn->escape_string($_POST['column_value']);
    $tables = $conn->escape_string($_POST['tables']);
    $from = $conn->escape_string($_POST['from']);
    $to = $conn->escape_string($_POST['to']);

    if ($column_value == "" || $from == "" || $to == "" || $column == "" || $tables == "") {
        $_SESSION['error_msg'] = "All fields is mandatory";
        header("location:report.php");
        exit;
    }

    // request_two_dates
    if ($tables == "user") {
        if ($column == "request_id") {
            $_SESSION['error_msg'] = "Request id does not exist in the users table";
            header("location:report.php");
            exit;
        }
        $_SESSION["client"] = "users_two_dates";
    } 
    
    if ($tables == "request_form") {
        $_SESSION["client"] = "users_two_dates";
    } 
    
    if ($tables == "customer") {

        if ($column == "paymentStatus") {
            $_SESSION['error_msg'] = "Payment Status does not exist in the client table";
            header("location:report.php");
            exit;
        }
        $_SESSION["client"] = "client";
    } 

    else {
        $_SESSION["client"] = "transactions";
    }
}


// between_two_dates
if (isset($_POST['between_two_dates'])) {

    $tables = $conn->escape_string($_POST['tables']);
    $from = $conn->escape_string($_POST['from']);
    $to = $conn->escape_string($_POST['to']);


    if ($from == "" || $to == "") {
        $_SESSION['error_msg'] = "All fields is mandatory";
        header("location:report.php");
        exit;
    }

    if ($tables == "user") {
        $_SESSION["client"] = "between_two_dates_user";
    } else if ($tables == "login_history") {
        $_SESSION["client"] = "login_histories";
    } else if ($tables == "request_form") {
        $_SESSION["client"] = "request_forms";
    } else {
        $_SESSION["client"] = "between_two_dates";
    }
}

// all_data

if (isset($_POST['all_data'])) {
    $tables = $conn->escape_string($_POST['tables']);

    // request_form
    if ($tables == "user") {
        $_SESSION["client"] = "user";
    } else if ($tables == "login_history") {
        $_SESSION["client"] = "login_history";
    } else if ($tables == "request_form") {
        $_SESSION["client"] = "request_form";
    } else {
        $_SESSION["client"] = "all_data";
    }
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
    <title>Generate Report</title>

    <style>
        .wrapper {
            width: 80%;
            margin: 0 auto;
        }

        .wrapper .header img {
            width: 100px;
            height: auto;
        }

        .img {
            width: 50px;
            height: auto;
        }

        table th,
        td {
            font-size: 11px;
        }
    </style>
</head>

<body>

    <!-- between two dates with company -->
    <?php
    if (isset($_SESSION["client"])) {

        // between_two_dates by company
        if ($_SESSION["client"] == "client") {
            $sql = "SELECT * FROM $tables WHERE dateAdded BETWEEN '$from' AND '$to' AND `$column`='$column_value' ORDER BY dateAdded ASC ";
            $res = $conn->query($sql);
        }

        if ($_SESSION["client"] == "transactions") {
            $sql = "SELECT * FROM $tables WHERE dateAdded BETWEEN '$from' AND '$to' AND `$column`='$column_value' ORDER BY dateAdded ASC ";
            $res = $conn->query($sql);
        }

        if ($_SESSION["client"] == "users_two_dates") {
            $sql = "SELECT * FROM $tables WHERE date_added BETWEEN '$from' AND '$to' AND `$column`='$column_value' ORDER BY date_added ASC ";
            $res = $conn->query($sql);
        }

        if ($_SESSION["client"] == "request_two_dates") {
            $sql = "SELECT * FROM $tables WHERE date_added BETWEEN '$from' AND '$to' AND `$column`='$column_value' ORDER BY date_added ASC ";
            $res = $conn->query($sql);
        }

        if ($_SESSION["client"] == "request_two_dates") {
            $sql = "SELECT * FROM $tables WHERE date_added BETWEEN '$from' AND '$to' AND `$column`='$column_value' ORDER BY date_added ASC ";
            $res = $conn->query($sql);
        }

        // between two dates by tables
        if ($_SESSION["client"] == "request_forms") {
            $sql = "SELECT * FROM $tables WHERE `date_added` BETWEEN '$from' AND '$to' ORDER BY `date_added` ASC ";
            $res = $conn->query($sql);
        }

        if ($_SESSION["client"] == "login_histories") {
            $sql = "SELECT * FROM $tables WHERE `login` BETWEEN '$from' AND '$to' ORDER BY `login` ASC ";
            $res = $conn->query($sql);
        }

        if ($_SESSION["client"] == "between_two_dates") {
            $sql = "SELECT * FROM $tables WHERE dateAdded BETWEEN '$from' AND '$to' ORDER BY dateAdded ASC ";
            $res = $conn->query($sql);
        }

        if ($_SESSION['client'] == "between_two_dates_user") {
            $sql = "SELECT * FROM $tables WHERE date_added BETWEEN '$from' AND '$to' ORDER BY date_added ASC ";
            $res = $conn->query($sql);
        }

        if ($_SESSION["client"] == "all_data") {
            $sql = "SELECT * FROM $tables ORDER BY dateAdded ASC ";
            $res = $conn->query($sql);
        }

        if ($_SESSION["client"] == "user") {
            $sql = "SELECT * FROM $tables ORDER BY date_added ASC ";
            $res = $conn->query($sql);
        }

        if ($_SESSION["client"] == "login_history") {
            $sql = "SELECT * FROM $tables ORDER BY `login` ASC ";
            $res = $conn->query($sql);
        }

        if ($_SESSION["client"] == "request_form") {
            $sql = "SELECT * FROM $tables ORDER BY `date_added` ASC ";
            $res = $conn->query($sql);
        }

        // all_data
        // 
        if ($res->num_rows > 0) {
            // check table name

            if ($tables == "customer") { ?>
                <div class="wrapper">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="report.php" class="btn btn-dark text-decoration-none mt-4" id="back">back</a>
                        <div class="">
                            <button class="btn btn-outline-secondary" id="print"><i class='bx bx-printer fs-4' onclick="output()"></i></button>
                            <button class="btn btn-outline-secondary" id="pdf"><i class='bx bx-download fs-4' onclick="generate_pdf()"></i></button>
                        </div>
                    </div>
                    <div id="generate-table">

                        <div class="header d-flex align-items-center justify-content-center">
                            <img src="img/ZIGNET.png" alt="" style="width: 100px; height: auto;">
                            <h1 class="text-left mx-3">Zignet <br> Autoworks</h1>
                        </div>
                        <div class="text-center">
                            <span class="fs-4 ">(Clients)</span>
                        </div>


                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">Client ID</th>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">CS Number</th>
                                    <th scope="col">Model</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Date Modified</th>
                                    <th scope="col">Form</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                while ($row = $res->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?= $row['client_id'] ?></td>
                                        <td><?= $row['customerName'] ?></td>
                                        <td><?= $row['csNumber'] ?></td>
                                        <td><?= $row['model'] ?></td>
                                        <td><?= $row['company'] ?></td>
                                        <td><?= $row['dateAdded'] ?></td>
                                        <td><?= $row['dateModified'] ?></td>
                                        <td><img src="uploads/<?= $row['img_path'] ?>" alt="" class="img"></td>
                                    </tr>
                                <?php
                                }
                                unset($_SESSION["client"]);

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php
            }

            if ($tables == "transactions_history") { ?>
                <div class="wrapper">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="report.php" class="btn btn-dark text-decoration-none mt-4" id="back">back</a>
                        <div class="">
                            <button class="btn btn-outline-secondary" id="print"><i class='bx bx-printer fs-4' onclick="output()"></i></button>
                            <button class="btn btn-outline-secondary" id="pdf"><i class='bx bx-download fs-4' onclick="generate_pdf()"></i></button>
                        </div>
                    </div>
                    <div id="generate-table">

                        <div class="header d-flex align-items-center justify-content-center">
                            <img src="img/ZIGNET.png" alt="" style="width: 100px; height: auto;">
                            <h1 class="text-left mx-3">Zignet <br> Autoworks</h1>
                        </div>
                        <div class="text-center">
                            <span class="fs-4 ">(Transactions History)</span>
                        </div>

                        <table class="table mt-4">
                            <thead>
                                <tr>

                                    <th scope="col">Client ID</th>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">CS Number</th>
                                    <th scope="col">Date Added</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Date Paid</th>
                                    <th scope="col">Reciept</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                while ($row = $res->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?= $row['client_id'] ?></td>
                                        <td><?= $row['customerName'] ?></td>
                                        <td><?= $row['csNumber'] ?></td>
                                        <td><?= $row['dateAdded'] ?></td>
                                        <td><?= $row['paymentStatus'] ?></td>
                                        <td><?= $row['date_paid'] ?></td>
                                        <td><img src="uploads/<?= $row['reciept'] ?>" alt="" class="img"></td>
                                    </tr>
                                <?php
                                }
                                unset($_SESSION["client"]);

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php
            }

            if ($tables == "user") { ?>
                <div class="wrapper">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="report.php" class="btn btn-dark text-decoration-none mt-4" id="back">back</a>
                        <div class="">
                            <button class="btn btn-outline-secondary" id="print"><i class='bx bx-printer fs-4' onclick="output()"></i></button>
                            <button class="btn btn-outline-secondary" id="pdf"><i class='bx bx-download fs-4' onclick="generate_pdf()"></i></button>
                        </div>
                    </div>
                    <div id="generate-table">

                        <div class="header d-flex align-items-center justify-content-center">
                            <img src="img/ZIGNET.png" alt="" style="width: 100px; height: auto;">
                            <h1 class="text-left mx-3">Zignet <br> Autoworks</h1>
                        </div>
                        <div class="text-center">
                            <span class="fs-4 ">(Users)</span>
                        </div>

                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">User ID</th>
                                    <th scope="col">Display Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Date Added</th>
                                    <th scope="col">Date Modified</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                while ($row = $res->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?= $row['user_id'] ?></td>
                                        <td><?= $row['display_name'] ?></td>
                                        <td><?= $row['username'] ?></td>
                                        <td><?= $row['password'] ?></td>
                                        <td><?= $row['contact'] ?></td>
                                        <td><?= $row['date_added'] ?></td>
                                        <td><?= $row['date_modified'] ?></td>
                                        <?php
                                        if ($row['active'] != 1) {
                                        ?>
                                            <td class="text-danger ">Deactivated</td>
                                        <?php
                                        } else {
                                        ?>
                                            <td class="text-success ">Activated</td>
                                        <?php
                                        }
                                        ?>

                                    </tr>
                                <?php
                                }
                                unset($_SESSION["client"]);

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php
            }

            if ($tables == "request_form") { ?>
                <div class="wrapper">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="report.php" class="btn btn-dark text-decoration-none mt-4" id="back">back</a>
                        <div class="">
                            <button class="btn btn-outline-secondary" id="print"><i class='bx bx-printer fs-4' onclick="output()"></i></button>
                            <button class="btn btn-outline-secondary" id="pdf"><i class='bx bx-download fs-4' onclick="generate_pdf()"></i></button>
                        </div>
                    </div>
                    <div id="generate-table">

                        <div class="header d-flex align-items-center justify-content-center">
                            <img src="img/ZIGNET.png" alt="" style="width: 80px; height: auto;">
                            <h1 class="text-left mx-3">Zignet <br> Autoworks</h1>
                        </div>
                        <div class="text-center">
                            <span class="fs-4 ">(Request Forms)</span>
                        </div>

                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Request ID</th>
                                    <th>Customer Name</th>
                                    <th>Address</th>
                                    <th>Service</th>
                                    <th>Description of Service</th>
                                    <th>Status</th>
                                    <th>Schedule</th>
                                    <th>Date Created</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                while ($row = $res->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?= $row['user_id'] ?></td>
                                        <td><?= $row['request_id'] ?></td>
                                        <td><?= $row['display_name'] ?></td>
                                        <td><?= $row['address'] ?></td>
                                        <td><?= $row['service'] ?></td>
                                        <td>
                                            <p><?= $row['description_of_service'] ?></p>
                                        </td>
                                        <?php
                                        if ($row['request_status'] == "pending") {
                                        ?>
                                            <td><span class="text-warning badge"><?= $row['request_status'] ?></span></td>
                                        <?php
                                        } else if ($row['request_status'] == "disapprove") {
                                        ?>
                                            <td><span class="text-danger badge"><?= $row['request_status'] ?></span></td>
                                        <?php
                                        } else {
                                        ?>
                                            <td><span class="text-success badge"><?= $row['request_status'] ?></span></td>
                                        <?php
                                        }
                                        ?>

                                        <td><?= $row['schedule'] ?></td>
                                        <td><?= $row['date_added'] ?></td>
                                    </tr>
                                <?php
                                }
                                unset($_SESSION["client"]);

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php
            }

            if ($tables == "login_history") { ?>
                <div class="wrapper">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="report.php" class="btn btn-dark text-decoration-none mt-4" id="back">back</a>
                        <div class="">
                            <button class="btn btn-outline-secondary" id="print"><i class='bx bx-printer fs-4' onclick="output()"></i></button>
                            <button class="btn btn-outline-secondary" id="pdf"><i class='bx bx-download fs-4' onclick="generate_pdf()"></i></button>
                        </div>
                    </div>
                    <div id="generate-table">

                        <div class="header d-flex align-items-center justify-content-center">
                            <img src="img/ZIGNET.png" alt="" style="width: 100px; height: auto;">
                            <h1 class="text-left mx-3">Zignet <br> Autoworks</h1>
                        </div>
                        <div class="text-center">
                            <span class="fs-4 ">(Users)</span>
                        </div>

                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th>Admin ID</th>
                                    <th>Admin Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Login Date</th>
                                    <th>Logout Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                while ($row = $res->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?= $row['adminID'] ?></td>
                                        <td><?= $row['adminName'] ?></td>
                                        <td><?= $row['username'] ?></td>
                                        <td><?= $row['role'] ?></td>
                                        <td><?= $row['login'] ?></td>
                                        <td><?= $row['logout'] ?></td>
                                    </tr>
                                <?php
                                }
                                unset($_SESSION["client"]);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
    <?php
            }
        } else {
            $_SESSION['error_msg'] = "No record found in the databse";
            header("location:report.php");
            exit;
        }
    }

    ?>


    <script src="html2pdf/html2pdf.bundle.min.js"></script>

    <script>
        function generate_pdf() {
            var report = document.getElementById("generate-table");

            var opt = {
                margin: 1,
                filename: "reports.pdf",
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 1
                },
                jsPDF: {
                    unit: 'in',
                    format: 'Legal',
                    orientation: 'L',
                    compressPDF: true
                },
            };

            html2pdf().set(opt).from(report).save();
        }

        function output() {
            document.getElementById("print").style.display = "none";
            document.getElementById("pdf").style.display = "none";
            document.getElementById("back").style.display = "none";
            window.print();
            window.location.reload();
        }
    </script>
</body>

</html>