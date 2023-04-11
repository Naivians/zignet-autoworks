<?php
session_start();
include "includes/config.php";
include "functions.php";

if (isset($_POST['client'])) {

    $company = $conn->escape_string($_POST['company']);
    $tables = $conn->escape_string($_POST['tables']);
    $from = $conn->escape_string($_POST['from']);
    $to = $conn->escape_string($_POST['to']);
    $_SESSION["client"] = "client";

    if ($company == "" || $from == "" || $to == "") {
        $_SESSION['error_msg'] = "All fields is mandatory";
        header("location:report.php");
        exit;
    }
}


// between_two_dates

if (isset($_POST['between_two_dates'])) {

    $tables = $conn->escape_string($_POST['tables']);
    $from = $conn->escape_string($_POST['from']);
    $to = $conn->escape_string($_POST['to']);
    $_SESSION["client"] = "between_two_dates";

    if ($from == "" || $to == "") {
        $_SESSION['error_msg'] = "All fields is mandatory";
        header("location:report.php");
        exit;
    }
}

// all_data


if (isset($_POST['all_data'])) {
    $tables = $conn->escape_string($_POST['tables']);
    $_SESSION["client"] = "all_data";
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
            font-size: 10px;
        }
    </style>
</head>

<body>

    <!-- between two dates with company -->
    <?php
    if (isset($_SESSION["client"])) {

        // between_two_dates
        if ($_SESSION["client"] == "client") {
            $sql = "SELECT * FROM $tables WHERE dateAdded BETWEEN '$from' AND '$to' AND company='$company' ORDER BY dateAdded ASC ";
            $res = $conn->query($sql);
        }

        if ($_SESSION["client"] == "between_two_dates") {
            $sql = "SELECT * FROM $tables WHERE dateAdded BETWEEN '$from' AND '$to' ORDER BY dateAdded ASC ";
            $res = $conn->query($sql);
        }

        if ($_SESSION["client"] == "all_data") {
            $sql = "SELECT * FROM $tables ORDER BY dateAdded ASC ";
            $res = $conn->query($sql);
        }

        // all_data

        if ($res->num_rows > 0) {
            // check table name
            if ($tables == "customer") { ?>
                <div class="wrapper">
                    <a href="report.php" class="btn btn-dark text-decoration-none mt-4">back</a>
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
                                    <th scope="col">Form</th>
                                    <th scope="col">Client ID</th>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">CS Number</th>
                                    <th scope="col">Model</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Date Added</th>
                                    <th scope="col">Date Modified</th>
                                    <th scope="col">Date Retrieved</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                while ($row = $res->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><img src="uploads/<?= $row['img_path'] ?>" alt="" class="img"></td>
                                        <td><?= $row['client_id'] ?></td>
                                        <td><?= $row['customerName'] ?></td>
                                        <td><?= $row['csNumber'] ?></td>
                                        <td><?= $row['model'] ?></td>
                                        <td><?= $row['company'] ?></td>
                                        <td><?= $row['dateAdded'] ?></td>
                                        <td><?= $row['dateModified'] ?></td>
                                        <td><?= $row['retrievedDate'] ?></td>
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

            if ($tables == "transactions_history") {
            ?>
                <div class="wrapper">
                    <a href="report.php" class="btn btn-dark text-decoration-none mt-4">back</a>
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
                                    <th scope="col">Reciept</th>
                                    <th scope="col">Client ID</th>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">CS Number</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Date Added</th>
                                    <th scope="col">Date Paid</th>
                                    <th scope="col">Date Retrieved</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                while ($row = $res->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><img src="uploads/<?= $row['reciept'] ?>" alt="" class="img"></td>
                                        <td><?= $row['client_id'] ?></td>
                                        <td><?= $row['customerName'] ?></td>
                                        <td><?= $row['csNumber'] ?></td>
                                        <td><?= $row['paymentStatus'] ?></td>
                                        <td><?= $row['dateAdded'] ?></td>
                                        <td><?= $row['date_paid'] ?></td>
                                        <td><?= $row['dateRetrieved'] ?></td>
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


    // generate deleted data
    if (isset($_GET["generate"])) {

        if ($_GET["generate"] == "deleted_client_account") {
            $sql = "SELECT * FROM `deleted_client_account` ORDER BY dateAdded ASC ";
            $res = $conn->query($sql);

            ?>
            <div class="wrapper">
                <a href="report.php" class="btn btn-dark text-decoration-none mt-4">back</a>
                <div id="generate-table">

                    <div class="header d-flex align-items-center justify-content-center">
                        <img src="img/ZIGNET.png" alt="" style="width: 100px; height: auto;">
                        <h1 class="text-left mx-3">Zignet <br> Autoworks</h1>
                    </div>
                    <div class="text-center">
                        <span class="fs-4 ">(Deleted Clients)</span>
                    </div>

                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th scope="col">Form</th>
                                <th scope="col">Client ID</th>
                                <th scope="col">Client Name</th>
                                <th scope="col">CS Number</th>
                                <th scope="col">Model</th>
                                <th scope="col">Company</th>
                                <th scope="col">Date Added</th>
                                <th scope="col">Date Modified</th>
                                <th scope="col">Date Retrieved</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            while ($row = $res->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><img src="uploads/<?= $row['img_path'] ?>" alt="" class="img"></td>
                                    <td><?= $row['client_id'] ?></td>
                                    <td><?= $row['customerName'] ?></td>
                                    <td><?= $row['csNumber'] ?></td>
                                    <td><?= $row['model'] ?></td>
                                    <td><?= $row['company'] ?></td>
                                    <td><?= $row['dateAdded'] ?></td>
                                    <td><?= $row['dateModified'] ?></td>
                                    <td><?= $row['retrievedDate'] ?></td>
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

        if ($_GET["generate"] == "deleted_transactions_history") {
            $sql = "SELECT * FROM `deleted_transactions_history` ORDER BY dateAdded ASC ";
            $res = $conn->query($sql);

        ?>
            <div class="wrapper">
                <a href="report.php" class="btn btn-dark text-decoration-none mt-4">back</a>
                <div id="generate-table">

                    <div class="header d-flex align-items-center justify-content-center">
                        <img src="img/ZIGNET.png" alt="" style="width: 100px; height: auto;">
                        <h1 class="text-left mx-3">Zignet <br> Autoworks</h1>
                    </div>
                    <div class="text-center">
                        <span class="fs-4 ">(Deleted Transactions History)</span>
                    </div>

                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th scope="col">Reciept</th>
                                <th scope="col">Client ID</th>
                                <th scope="col">Client Name</th>
                                <th scope="col">CS Number</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Date Added</th>
                                <th scope="col">Date Paid</th>
                                <th scope="col">Date Retrieved</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            while ($row = $res->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><img src="uploads/<?= $row['reciept'] ?>" alt="" class="img"></td>
                                    <td><?= $row['client_id'] ?></td>
                                    <td><?= $row['customerName'] ?></td>
                                    <td><?= $row['csNumber'] ?></td>
                                    <td><?= $row['paymentStatus'] ?></td>
                                    <td><?= $row['dateAdded'] ?></td>
                                    <td><?= $row['date_paid'] ?></td>
                                    <td><?= $row['dateRetrieved'] ?></td>
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

        if ($_GET["generate"] == "login_history") {
            $sql = "SELECT * FROM `login_history` ORDER BY `login` ASC ";
            $res = $conn->query($sql);
        ?>
            <div class="wrapper">
                <a href="report.php" class="btn btn-dark text-decoration-none mt-4">back</a>
                <div id="generate-table">

                    <div class="header d-flex align-items-center justify-content-center">
                        <img src="img/ZIGNET.png" alt="" style="width: 100px; height: auto;">
                        <h1 class="text-left mx-3">Zignet <br> Autoworks</h1>
                    </div>
                    <div class="text-center">
                        <span class="fs-4 ">(Login History)</span>
                    </div>

                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th scope="col">Login ID</th>
                                <th scope="col">Admin ID</th>
                                <th scope="col">Admin Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Role</th>
                                <th scope="col">Time In</th>
                                <th scope="col">Time Out</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            while ($row = $res->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= $row['loginID'] ?></td>
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
    }
    ?>


    <script src="html2pdf/html2pdf.bundle.min.js"></script>

    <script>
        var report = document.getElementById("generate-table");

        var opt = {
            margin: .5,
            filename: "patients info.pdf",
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'Letter',
                orientation: 'Portrait',
                compressPDF: true
            },
        };

        html2pdf().set(opt).from(report).save();
    </script>
</body>

</html>